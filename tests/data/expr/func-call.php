<?php declare(strict_types=1);

class Helper
{
    public function joinOnSteroids(string $glue, array $arr)
    {
        $lower = strtolower($upper = strtoupper($original = join($glue, $arr)));
        return [
            'lowercase' => $lower,
            'uppercase' => $upper,
            'original' => $original,
        ];
    }
}
