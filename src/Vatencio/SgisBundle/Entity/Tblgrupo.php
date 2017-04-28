<?php

namespace Vatencio\SgisBundle\Entity;

/**
 * Tblgrupo
 */
class Tblgrupo
{
    /**
     * @var integer
     */
    private $intidgrupo;

    /**
     * @var string
     */
    private $strnombre;

    /**
     * @var \DateTime
     */
    private $dtmcreacion;

    /**
     * @var string
     */
    private $strcreacion;

    /**
     * @var \DateTime
     */
    private $dtmactualizacion;

    /**
     * @var string
     */
    private $stractualizacion;

    /**
     * @var \Vatencio\SgisBundle\Entity\Tblcurso
     */
    private $intidcurso;

    /**
     * @var \Vatencio\SgisBundle\Entity\Tbldocente
     */
    private $intiddocente;


    /**
     * Get intidgrupo
     *
     * @return integer
     */
    public function getIntidgrupo()
    {
        return $this->intidgrupo;
    }

    /**
     * Set strnombre
     *
     * @param string $strnombre
     *
     * @return Tblgrupo
     */
    public function setStrnombre($strnombre)
    {
        $this->strnombre = $strnombre;

        return $this;
    }

    /**
     * Get strnombre
     *
     * @return string
     */
    public function getStrnombre()
    {
        return $this->strnombre;
    }

    /**
     * Set dtmcreacion
     *
     * @param \DateTime $dtmcreacion
     *
     * @return Tblgrupo
     */
    public function setDtmcreacion($dtmcreacion)
    {
        $this->dtmcreacion = $dtmcreacion;

        return $this;
    }

    /**
     * Get dtmcreacion
     *
     * @return \DateTime
     */
    public function getDtmcreacion()
    {
        return $this->dtmcreacion;
    }

    /**
     * Set strcreacion
     *
     * @param string $strcreacion
     *
     * @return Tblgrupo
     */
    public function setStrcreacion($strcreacion)
    {
        $this->strcreacion = $strcreacion;

        return $this;
    }

    /**
     * Get strcreacion
     *
     * @return string
     */
    public function getStrcreacion()
    {
        return $this->strcreacion;
    }

    /**
     * Set dtmactualizacion
     *
     * @param \DateTime $dtmactualizacion
     *
     * @return Tblgrupo
     */
    public function setDtmactualizacion($dtmactualizacion)
    {
        $this->dtmactualizacion = $dtmactualizacion;

        return $this;
    }

    /**
     * Get dtmactualizacion
     *
     * @return \DateTime
     */
    public function getDtmactualizacion()
    {
        return $this->dtmactualizacion;
    }

    /**
     * Set stractualizacion
     *
     * @param string $stractualizacion
     *
     * @return Tblgrupo
     */
    public function setStractualizacion($stractualizacion)
    {
        $this->stractualizacion = $stractualizacion;

        return $this;
    }

    /**
     * Get stractualizacion
     *
     * @return string
     */
    public function getStractualizacion()
    {
        return $this->stractualizacion;
    }

    /**
     * Set intidcurso
     *
     * @param \Vatencio\SgisBundle\Entity\Tblcurso $intidcurso
     *
     * @return Tblgrupo
     */
    public function setIntidcurso(\Vatencio\SgisBundle\Entity\Tblcurso $intidcurso = null)
    {
        $this->intidcurso = $intidcurso;

        return $this;
    }

    /**
     * Get intidcurso
     *
     * @return \Vatencio\SgisBundle\Entity\Tblcurso
     */
    public function getIntidcurso()
    {
        return $this->intidcurso;
    }

    /**
     * Set intiddocente
     *
     * @param \Vatencio\SgisBundle\Entity\Tbldocente $intiddocente
     *
     * @return Tblgrupo
     */
    public function setIntiddocente(\Vatencio\SgisBundle\Entity\Tbldocente $intiddocente = null)
    {
        $this->intiddocente = $intiddocente;

        return $this;
    }

    /**
     * Get intiddocente
     *
     * @return \Vatencio\SgisBundle\Entity\Tbldocente
     */
    public function getIntiddocente()
    {
        return $this->intiddocente;
    }
}
