<?php

declare(strict_types=1);

namespace TomasKulhanek\CzechDataBox\DTO;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use TomasKulhanek\CzechDataBox\Traits\QTimestamp;

#[Serializer\XmlRoot(name: 'p:dmReturnedMessageEnvelope')]
#[Serializer\XmlNamespace(uri: 'http://isds.czechpoint.cz/v20', prefix: 'p')]
class ReturnedMessageEnvelope
{
	use QTimestamp;

	#[Serializer\Type('string')]
	#[Serializer\SerializedName('dmType')]
	#[Serializer\XmlAttribute]
	#[Assert\NotBlank(allowNull: false)]
	protected string $type;

	#[Serializer\Type(MessageEnvelope::class)]
	#[Serializer\SerializedName('p:dmDm')]
	#[Serializer\XmlElement(cdata: false)]
	#[Assert\Valid()]
	protected MessageEnvelope $dataMessage;

	#[Serializer\Type(Hash::class)]
	#[Serializer\SerializedName('p:dmHash')]
	#[Serializer\XmlElement(cdata: false)]
	#[Assert\Valid()]
	protected Hash $hash;

	#[Serializer\SkipWhenEmpty]
	#[Serializer\Type("DateTimeImmutable<'Y-m-d\\TH:i:s.uP','Europe/Prague'>")]
	#[Serializer\XmlElement(cdata: false)]
	#[Serializer\SerializedName('p:dmDeliveryTime')]
	protected ?DateTimeImmutable $deliveryTime = null;

	#[Serializer\Type("DateTimeImmutable<'Y-m-d\\TH:i:s.uP','Europe/Prague'>")]
	#[Serializer\XmlElement(cdata: false)]
	#[Serializer\SerializedName('p:dmAcceptanceTime')]
	#[Serializer\SkipWhenEmpty]
	protected ?DateTimeImmutable $acceptanceTime = null;

	#[Serializer\Type('int')]
	#[Serializer\SerializedName('p:dmMessageStatus')]
	#[Serializer\XmlElement(cdata: false)]
	#[Assert\Positive()]
	protected int $messageStatus;

	#[Serializer\Type('int')]
	#[Serializer\SerializedName('p:dmAttachmentSize')]
	#[Serializer\XmlElement(cdata: false)]
	#[Assert\Positive()]
	protected int $attachmentSize;

	public function getType(): string
	{
		return $this->type;
	}

	public function setType(string $type): ReturnedMessageEnvelope
	{
		$this->type = $type;
		return $this;
	}

	public function getDataMessage(): MessageEnvelope
	{
		return $this->dataMessage;
	}

	public function setDataMessage(MessageEnvelope $dataMessage): ReturnedMessageEnvelope
	{
		$this->dataMessage = $dataMessage;
		return $this;
	}

	public function getHash(): Hash
	{
		return $this->hash;
	}

	public function setHash(Hash $hash): ReturnedMessageEnvelope
	{
		$this->hash = $hash;
		return $this;
	}

	public function getDeliveryTime(): ?DateTimeImmutable
	{
		return $this->deliveryTime;
	}

	public function setDeliveryTime(?DateTimeImmutable $deliveryTime): ReturnedMessageEnvelope
	{
		$this->deliveryTime = $deliveryTime;
		return $this;
	}

	public function getAcceptanceTime(): ?DateTimeImmutable
	{
		return $this->acceptanceTime;
	}

	public function setAcceptanceTime(?DateTimeImmutable $acceptanceTime): ReturnedMessageEnvelope
	{
		$this->acceptanceTime = $acceptanceTime;
		return $this;
	}

	public function getMessageStatus(): int
	{
		return $this->messageStatus;
	}

	public function setMessageStatus(int $messageStatus): ReturnedMessageEnvelope
	{
		$this->messageStatus = $messageStatus;
		return $this;
	}

	public function getAttachmentSize(): int
	{
		return $this->attachmentSize;
	}

	public function setAttachmentSize(int $attachmentSize): ReturnedMessageEnvelope
	{
		$this->attachmentSize = $attachmentSize;
		return $this;
	}
}
