<?php
/**
 * Détermine la classe CSS selon la température
 */
function get_temperature_class($temperature) {
    $temp = floatval($temperature);
    
    if ($temp <= 10) {
        return 'froid';
    } elseif ($temp > 10 && $temp <= 20) {
        return 'frais';
    } elseif ($temp > 20 && $temp <= 25) {
        return 'doux';
    } elseif ($temp > 25 && $temp <= 30) {
        return 'chaud';
    } else {
        return 'tres-chaud';
    }
}

/**
 * Retourne une description textuelle selon la température
 */
function get_temperature_description($temperature, $type = 'moy') {
    $temp = floatval($temperature);
    
    $descriptions = [
        'froid' => [
            'min' => 'Très froid, équipez-vous bien',
            'max' => 'Pic de froid, protection nécessaire',
            'moy' => 'Climat froid'
        ],
        'frais' => [
            'min' => 'Températures fraîches',
            'max' => 'Agréablement frais',
            'moy' => 'Climat tempéré'
        ],
        'doux' => [
            'min' => 'Douceur garantie',
            'max' => 'Parfait pour les activités',
            'moy' => 'Climat idéal'
        ],
        'chaud' => [
            'min' => 'Chaleur agréable',
            'max' => 'Il fait chaud, hydratez-vous',
            'moy' => 'Climat chaud'
        ],
        'tres-chaud' => [
            'min' => 'Très chaud même au minimum',
            'max' => 'Chaleur intense, précautions requises',
            'moy' => 'Climat très chaud'
        ]
    ];
    
    $class = get_temperature_class($temp);
    return $descriptions[$class][$type] ?? 'Température agréable';
}