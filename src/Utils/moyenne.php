<?php
/**
 * Created by PhpStorm.
 * User: tongguillaume
 * Date: 2019-04-09
 * Time: 22:12
 */

namespace App\Utils;


use App\Entity\Notes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class moyenne extends AbstractController
{

    public static function arraymoyenne($array, $lenght)
    {
        //$array d'objet note
        $array_moyenne = array();

        for ($i = 1; $i < $lenght +1; $i++) {
            $coeff = 0;
            $array_moyenne[$i] = 0;

            for ($j = 0; $j < count($array); $j++) {
                if ($array[$j]['matiere_id_id'] == $i) {
                    $array_moyenne[$i] += $array[$j]['note'] * $array[$j]['coefficient'];
                    $coeff += $array[$j]['coefficient'];
                }
            }
            if ($coeff != 0)
                $array_moyenne[$i] = $array_moyenne[$i] / $coeff;
        }
        dump($array);
        return $array_moyenne;
    }

    public static function moyenneofmatter($array_note, $array_matiere,$lenght)
    {
        $res = 0;
        $total_coeff = 0;

        for ($i = 1; $i < count($array_matiere); $i++) {
            $res += $array_note[$i ] * $array_matiere[$i]['coefficient'];
            $total_coeff +=  $array_matiere[$i]['coefficient'];
        }

        $res /= $total_coeff;
        return $res;
    }
}