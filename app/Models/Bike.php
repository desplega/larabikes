<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;

    protected $fillable = ['marca', 'modelo', 'kms', 'precio', 'matriculada', 'imagen', 'matricula', 'color'];

    /**
     * Use white for text on light colors.
     * Light color is considered when at least to main colors are high (above '0xA0')
     * 
     * QUESTION: Should this function be in the model?
     */
    public function whiteText() {
        $red = strtoupper(substr($this->color, 1, 2));
        $green = strtoupper(substr($this->color, 3, 2));
        $blue = strtoupper(substr($this->color, 5, 2));

        $white = 0;

        if ($red < 'A0')
            $white++;
        if ($green < 'A0')
            $white++;
        if ($blue < 'A0')
            $white++;

        if ($white > 1)
            return 'color: white;';
        else
            return '';
    }
}
