<?php

namespace Vatencio\SgisBundle\Entity;

/**
 * Tblmenu
 */
class Tblmenu
{
    /**
     * @var integer
     */
    private $intidmenu;

    /**
     * @var string
     */
    private $strnombre;

    /**
     * @var string
     */
    private $strurl;

    /**
     * @var string
     */
    private $strdescripcion;

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
     * @var \Vatencio\SgisBundle\Entity\Tblmenu
     */
    private $intidpadre;


    /**
     * Get intidmenu
     *
     * @return integer
     */
    public function getIntidmenu()
    {
        return $this->intidmenu;
    }

    /**
     * Set strnombre
     *
     * @param string $strnombre
     *
     * @return Tblmenu
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
     * Set strurl
     *
     * @param string $strurl
     *
     * @return Tblmenu
     */
    public function setStrurl($strurl)
    {
        $this->strurl = $strurl;

        return $this;
    }

    /**
     * Get strurl
     *
     * @return string
     */
    public function getStrurl()
    {
        return $this->strurl;
    }

    /**
     * Set strdescripcion
     *
     * @param string $strdescripcion
     *
     * @return Tblmenu
     */
    public function setStrdescripcion($strdescripcion)
    {
        $this->strdescripcion = $strdescripcion;

        return $this;
    }

    /**
     * Get strdescripcion
     *
     * @return string
     */
    public function getStrdescripcion()
    {
        return $this->strdescripcion;
    }

    /**
     * Set dtmcreacion
     *
     * @param \DateTime $dtmcreacion
     *
     * @return Tblmenu
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
     * @return Tblmenu
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
     * @return Tblmenu
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
     * @return Tblmenu
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
     * Set intidpadre
     *
     * @param \Vatencio\SgisBundle\Entity\Tblmenu $intidpadre
     *
     * @return Tblmenu
     */
    public function setIntidpadre(\Vatencio\SgisBundle\Entity\Tblmenu $intidpadre = null)
    {
        $this->intidpadre = $intidpadre;

        return $this;
    }

    /**
     * Get intidpadre
     *
     * @return \Vatencio\SgisBundle\Entity\Tblmenu
     */
    public function getIntidpadre()
    {
        return $this->intidpadre;
    }
}

