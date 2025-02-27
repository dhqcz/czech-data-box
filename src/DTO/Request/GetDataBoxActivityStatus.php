<?php

declare(strict_types=1);

namespace TomasKulhanek\CzechDataBox\DTO\Request;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;
use TomasKulhanek\CzechDataBox\Traits\DataBoxId;

#[Serializer\XmlNamespace(uri: 'http://isds.czechpoint.cz/v20', prefix: 'p')]
#[Serializer\XmlRoot(name: 'p:GetDataBoxActivityStatus', namespace: 'http://isds.czechpoint.cz/v20')]
#[Serializer\AccessorOrder(order: 'custom', custom: ['dataBoxId', 'from', 'to'])]
class GetDataBoxActivityStatus implements IRequest
{
	use DataBoxId;

	#[Serializer\Type("DateTimeImmutable<'Y-m-d\\TH:i:s.uP','Europe/Prague'>")]
	#[Serializer\XmlElement(cdata: false)]
	#[Serializer\SerializedName('p:baFrom')]
	private DateTimeImmutable $from;

	#[Serializer\Type("DateTimeImmutable<'Y-m-d\\TH:i:s.uP','Europe/Prague'>")]
	#[Serializer\XmlElement(cdata: false)]
	#[Serializer\SerializedName('p:baTo')]
	private DateTimeImmutable $to;

	public function __construct()
	{
		$this->setTo((new DateTimeImmutable()));
		$this->setFrom((new DateTimeImmutable('-3 month')));
	}

	public function getFrom(): DateTimeImmutable
	{
		return $this->from;
	}

	public function setFrom(DateTimeImmutable $from): GetDataBoxActivityStatus
	{
		$this->from = $from;
		return $this;
	}

	public function getTo(): DateTimeImmutable
	{
		return $this->to;
	}

	public function setTo(DateTimeImmutable $to): GetDataBoxActivityStatus
	{
		$this->to = $to;
		return $this;
	}
}
