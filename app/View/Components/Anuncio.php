<?php

namespace App\View\Components;

use App\Models\Anuncio as AnuncioModel;
use Illuminate\View\Component;

class Anuncio extends Component
{
    public $posicion;
    public $categoria_id;
    public $universidad_id;
    public $limite;
    public $anuncios;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($posicion, $categoriaId = null, $universidadId = null, $limite = 1)
    {
        $this->posicion = $posicion;
        $this->categoria_id = $categoriaId;
        $this->universidad_id = $universidadId;
        $this->limite = $limite;
        
        // Obtener anuncios activos para esta posición
        $query = AnuncioModel::activos()->porPosicion($posicion);
        
        if ($categoriaId) {
            $query->where('categoria_id', $categoriaId);
        }
        
        if ($universidadId) {
            $query->where('universidad_id', $universidadId);
        }
        
        $this->anuncios = $query->inRandomOrder()->limit($limite)->get();
        
        // Registrar impresiones
        foreach ($this->anuncios as $anuncio) {
            $anuncio->registrarImpresion();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.anuncio');
    }
}
