<?php

namespace App\Imports;

use App\Candidate;
use Maatwebsite\Excel\Concerns\ToModel;

class CandidateImports implements ToModel
{
    private $programme_id;
    private $type;

    public function __construct($programme_id, $type)
    {
        $this->programme_id = $programme_id;
        $this->type = $type;
    }

    /**
     * @param array $row
     *
     * @return Candidate
     */
    public function model(array $row)
    {
        return new Candidate([
            'identity_card' => $row[0],
            'name'    => $row[1],
            'type' => $this->type,
            'programme_id' => $this->programme_id
        ]);
    }
}