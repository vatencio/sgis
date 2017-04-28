<?php

namespace Vatencio\SgisBundle\Entity;

/**
 * Tblperiodoyear
 */
class Tblperiodoyear
{
    /**
     * @var integer
     */
    private $intidperiodoyear;

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
     * @var \Vatencio\SgisBundle\Entity\Tblperiodo
     */
    private $intidperiodo;

    /**
     * @var \Vatencio\SgisBundle\Entity\Tblyear
     */
    private $intidyear;


    /**
     * Get intidperiodoyear
     *
     * @return integer
     */
    public function getIntidperiodoyear()
    {
        return $this->intidperiodoyear;
    }

    /**
     * Set strnombre
     *
     * @param string $strnombre
     *
     * @return Tblperiodoyear
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
     * @return Tblperiodoyear
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
     * @return Tblperiodoyear
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
     * @return Tblperiodoyear
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
     * @return Tblperiodoyear
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
     * Set intidperiodo
     *
     * @param \Vatencio\SgisBundle\Entity\Tblperiodo $intidperiodo
     *
     * @return Tblperiodoyear
     */
    public function setIntidperiodo(\Vatencio\SgisBundle\Entity\Tblperiodo $intidperiodo = null)
    {
        $this->intidperiodo = $intidperiodo;

        return $this;
    }

    /**
     * Get intidperiodo
     *
     * @return \Vatencio\SgisBundle\Entity\Tblperiodo
     */
    public function getIntidperiodo()
    {
        return $this->intidperiodo;
    }

    /**
     * Set intidyear
     *
     * @param \Vatencio\SgisBundle\Entity\Tblyear $intidyear
     *
     * @return Tblperiodoyear
     */
    public function setIntidyear(\Vatencio\SgisBundle\Entity\Tblyear $intidyear = null)
    {
        $this->intidyear = $intidyear;

        return $this;
    }

    /**
     * Get intidyear
     *
     * @return \Vatencio\SgisBundle\Entity\Tblyear
     */
    public function getIntidyear()
    {
        return $this->intidyear;
    }
}
