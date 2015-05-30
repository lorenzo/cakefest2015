<?php

namespace App\Model\Formatter;

class TotalSpeakers
{

    protected $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    public function __invoke($row)
    {
        if (empty($row[$this->field])) {
            return $row;
        }

        foreach ($row[$this->field] as &$lang) {
            $lang['total_speakers'] = ($lang['percentage'] / 100) *
                $row['population'];
        }
        return $row;
    }
}
