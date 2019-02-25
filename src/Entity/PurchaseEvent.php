<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PurchaseEventRepository")
 */
class PurchaseEvent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="purchaseEvents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customerId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="purchaseEvents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $productId;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $purchaseAmount;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $timestamp;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerId(): ?Customer
    {
        return $this->customerId;
    }

    public function setCustomerId(?Customer $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    public function getProductId(): ?Product
    {
        return $this->productId;
    }

    public function setProductId(?Product $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getPurchaseAmount()
    {
        return $this->purchaseAmount;
    }

    public function setPurchaseAmount($purchaseAmount): self
    {
        $this->purchaseAmount = $purchaseAmount;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
