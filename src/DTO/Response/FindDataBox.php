<?php

declare(strict_types=1);

namespace TomasKulhanek\CzechDataBox\DTO\Response;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use TomasKulhanek\CzechDataBox\DTO\OwnerInfo;
use TomasKulhanek\CzechDataBox\Traits\DataBoxStatus;

#[Serializer\XmlNamespace(uri: 'http://isds.czechpoint.cz/v20', prefix: 'p')]
#[Serializer\XmlRoot(name: 'p:FindDataBoxResponse', namespace: 'http://isds.czechpoint.cz/v20')]
class FindDataBox extends IResponse
{
	use DataBoxStatus;

	/**
	 * @var OwnerInfo[]
	 */
	#[Serializer\Type('array<TomasKulhanek\CzechDataBox\DTO\OwnerInfo>')]
	#[Serializer\XmlList(entry: 'dbOwnerInfo', inline: false, namespace: 'http://isds.czechpoint.cz/v20')]
	#[Serializer\SerializedName('dbResults')]
	#[Serializer\XmlElement(cdata: false, namespace: 'http://isds.czechpoint.cz/v20')]
	#[Assert\All([
		new Assert\Type(type: OwnerInfo::class)
	])]
	#[Assert\Valid()]
	protected array $result = [];

	/**
	 * @return OwnerInfo[]
	 */
	public function getResult(): array
	{
		return $this->result;
	}
}
