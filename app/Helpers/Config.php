<?php

namespace App\Helpers;

class Config
{

    public function formarNuevaCadenaUrl($cadena): string
    {
        // Reemplazar espacios por guiones
        $cadena = str_replace(' ', '-', $cadena);

        // Dividir la cadena en palabras
        $palabras = explode('-', $cadena);

        // Buscar la posición de la palabra 'catalogo'
        $indiceCatalogo = array_search('Lista', $palabras);

        // Si se encuentra la palabra 'catalogo'
        if ($indiceCatalogo !== false && isset($palabras[$indiceCatalogo + 1])) {
            // Tomar las palabras siguientes y convertirlas a minúsculas
            $nuevasPalabras = array_slice($palabras, $indiceCatalogo + 1);

            // Unir las palabras con guiones
            $nuevaCadena = strtolower(implode('-', $nuevasPalabras));

            return $nuevaCadena;
        }

        // En caso de que no se encuentre la palabra 'catalogo'
        return '';
    }
}
