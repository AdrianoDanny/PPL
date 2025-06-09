<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GoatDiseaseController extends Controller
{
    private $rules = [];

    public function __construct()
    {
        $this->loadRules();
    }

    private function loadRules()
    {
        $path = storage_path('app/public/dataset_kambing.csv');
        $file = fopen($path, 'r');

        // Skip header
        fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            $gejala = array_map('trim', explode(',', $row[6]));
            $gejala = array_filter($gejala, function($item) {
                return $item !== '-' && !empty($item);
            });

            $this->rules[] = [
                'conditions' => $gejala,
                'conclusion' => $row[7]
            ];
        }

        fclose($file);
    }

    private function forwardChaining($facts)
    {
        $detectedDiseases = [];

        foreach ($this->rules as $rule) {
            $matched = true;
            foreach ($rule['conditions'] as $condition) {
                if (!in_array($condition, $facts)) {
                    $matched = false;
                    break;
                }
            }

            if ($matched && !in_array($rule['conclusion'], $detectedDiseases)) {
                $detectedDiseases[] = $rule['conclusion'];
            }
        }

        return $detectedDiseases;
    }

    public function index()
    {
        return view('admin.goat-disease');
    }

    public function diagnose(Request $request)
    {
        $request->validate([
            'gejala' => 'required|array',
            'gejala.*' => 'string'
        ]);

        $facts = $request->input('gejala');
        $results = $this->forwardChaining($facts);

        return view('admin.goat-disease', [
            'results' => $results,
            'oldGejala' => $facts
        ]);
    }
}
