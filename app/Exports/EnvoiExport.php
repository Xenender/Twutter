<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class UsersExport
{
    protected $allMessagesText;

    public function __construct($allMessagesText)
    {
        $this->allMessagesText = $allMessagesText;
    }

    public function collection()
    {
        return new Collection($this->allMessagesText);
    }

    public function headings(): array
    {
        return [
            'Message',
            'Date',
            'Reçu'
        ];
    }
}