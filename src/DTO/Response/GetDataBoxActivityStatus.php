<?php

declare(strict_types=1);

namespace TomasKulhanek\CzechDataBox\DTO\Response;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use TomasKulhanek\CzechDataBox\DTO\Period;
use TomasKulhanek\CzechDataBox\Traits\DataBoxId;
use TomasKulhanek\CzechDataBox\Traits\DataBoxStatus;

#[Serializer\XmlNamespace(uri: 'http://isds.czechpoint.cz/v20', prefix: 'p')]
#[Serializer\XmlRoot(name: 'p:GetDataBoxActivityStatusResponse', namespace: 'http://isds.czechpoint.cz/v20')]
class GetDataBoxActivityStatus extends IResponse
{
	use DataBoxStatus;
	use DataBoxId;

	/**
	 * @var Period[]
	 */
	#[Serializer\Type('array<TomasKulhanek\CzechDataBox\DTO\Period>')]
	#[Serializer\XmlList(entry: 'Period', inline: false, namespace: 'http://isds.czechpoint.cz/v20')]
	#[Serializer\SerializedName('Periods')]
	#[Serializer\XmlElement(cdata: false, namespace: 'http://isds.czechpoint.cz/v20')]
	#[Assert\All([
		new Assert\Type(type: Period::class)
	])]
	#[Assert\Valid()]
	protected array $period = [];

	/**
	 * @return Period[]
	 */
	public function getPeriod(): array
	{
		return $this->period;
	}
}
