<?php


class Anime
{
    protected $nombre;
    protected $descripcion;
    protected $portada;
    protected $cover;

    function __construct($nombre,$descripcion,$portada,$cover){
        $this->nombre = $nombre;
        $this->nombre = $descripcion;
        $this->nombre = $portada;
        $this->nombre = $cover;
    }

	/**
	 * @return mixed
	 */
	public function getNombre() {
		return $this->nombre;
	}
	
	/**
	 * @return mixed
	 */
	public function getDescripcion() {
		return $this->descripcion;
	}
	
	/**
	 * @return mixed
	 */
	public function getPortada() {
		return $this->portada;
	}
	
	/**
	 * @return mixed
	 */
	public function getCover() {
		return $this->cover;
	}

	/**
	 * @param mixed $nombre 
	 * @return self
	 */
	public function setNombre($nombre): self {
		$this->nombre = $nombre;
		return $this;
	}
	
	/**
	 * @param mixed $descripcion 
	 * @return self
	 */
	public function setDescripcion($descripcion): self {
		$this->descripcion = $descripcion;
		return $this;
	}
	
	/**
	 * @param mixed $portada 
	 * @return self
	 */
	public function setPortada($portada): self {
		$this->portada = $portada;
		return $this;
	}
	
	/**
	 * @param mixed $cover 
	 * @return self
	 */
	public function setCover($cover): self {
		$this->cover = $cover;
		return $this;
	}
}