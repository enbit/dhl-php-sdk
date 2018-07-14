<?php

namespace Petschko\DHL;

/**
 * Author: Peter Dragicevic [peter@petschko.org]
 * Authors-Website: http://petschko.org/
 * Date: 26.01.2017
 * Time: 21:05
 * Update: 14.07.2018
 * Version: 0.0.4
 *
 * Notes: Contains the ExportDocument Class
 * ToDo: Please edit/add more details to the doc comments if you know more about them
 */

use Exception;
use stdClass;

/**
 * Class ExportDocument
 */
class ExportDocument {
	// Constants for Export-Type
	const EXPORT_TYPE_OTHER = 'OTHER';
	const EXPORT_TYPE_PRESENT = 'PRESENT';
	const EXPORT_TYPE_COMMERCIAL_SAMPLE = 'COMMERCIAL_SAMPLE';
	const EXPORT_TYPE_DOCUMENT = 'DOCUMENT';
	const EXPORT_TYPE_RETURN_OF_GOODS = 'RETURN_OF_GOODS';

	// Constants for Terms of Trade
	const TERMS_OF_TRADE_DDP = 'DDP';
	const TERMS_OF_TRADE_DXV = 'DXV';
	const TERMS_OF_TRADE_DDU = 'DDU';
	const TERMS_OF_TRADE_DDX = 'DDX';

	/**
	 * In case invoice has a number, client app can provide it in this field.
	 *
	 * Note: Optional
	 * Min-Len: -
	 * Max-Len: 35
	 *
	 * @var string|null $invoiceNumber - Invoice-Number or null for none
	 */
	private $invoiceNumber = null;

	/**
	 * Export type
	 * (depends on chosen product -> only mandatory for international, non EU shipments).
	 *
	 * Note: Required! (Even if just mandatory for international shipments)
	 *
	 * Possible values:
	 * OTHER
	 * PRESENT
	 * COMMERCIAL_SAMPLE
	 * DOCUMENT
	 * RETURN_OF_GOODS
	 *
	 * @var string $exportType - Export-Type (Can assigned with ExportDocument::EXPORT_TYPE_{TYPE} or as value)
	 */
	private $exportType;

	/**
	 * Description for Export-Type (especially needed if Export-Type is OTHER)
	 *
	 * Note: Optional|Required if "EXPORT_TYPE" is OTHER
	 * Min-Len: 1
	 * Max-Len: 256
	 *
	 * @var string|null $exportTypeDescription - Export-Description or null for none
	 */
	private $exportTypeDescription = null;

	/**
	 * Element provides terms of trades
	 *
	 * Note: Optional
	 * Min-Len: 3
	 * Max-Len: 3
	 *
	 * Possible values:
	 * DDP - Delivery Duty Paid
	 * DXV - Delivery duty paid (excl. VAT )
	 * DDU - DDU - Delivery Duty Paid
	 * DDX - Delivery duty paid (excl. Duties, taxes and VAT)
	 *
	 * @var string|null $termsOfTrade - Terms of trades (Can assigned with ExportDocument::TERMS_OF_TRADE_{TYPE})
	 * 									or null for none
	 */
	private $termsOfTrade = null;

	/**
	 * Place of committal
	 *
	 * Note: Required
	 * Min-Len: -
	 * Max-Len: 35
	 *
	 * @var string $placeOfCommittal - Place of committal is a Location
	 */
	private $placeOfCommittal;

	/**
	 * Additional custom fees to be payed
	 *
	 * Note: Required
	 *
	 * @var float $additionalFee - Additional fee
	 */
	private $additionalFee;

	/**
	 * Permit-Number
	 *
	 * Note: Optional
	 * Min-Len: -
	 * Max-Len: 10
	 *
	 * // todo/fixme: is this just an int or float?
	 * @var string|int|float|null $permitNumber - Permit number or null for none
	 */
	private $permitNumber = null;

	/**
	 * Attestation number
	 *
	 * Note: Optional
	 * Min-Len: -
	 * Max-Len: 35
	 *
	 * // todo/fixme: is this just an int or float?
	 * @var string|int|float|null $attestationNumber - The attestation number or null for none
	 */
	private $attestationNumber = null;

	/**
	 * Is with Electronic Export Notification
	 *
	 * Note: Optional
	 *
	 * @var bool|null $withElectronicExportNotification - Is with Electronic Export Notification or null for default
	 */
	private $withElectronicExportNotification = null;

	/**
	 * Contains the ExportDocPosition-Class(es)
	 *
	 * Note: Optional
	 *
	 * @var ExportDocPosition|array|null $exportDocPosition - ExportDocPosition-Class or an array with ExportDocPosition-Objects or null if not needed
	 */
	private $exportDocPosition = null;

	/**
	 * ExportDocument constructor.
	 */
	public function __construct() {
		// VOID
	}

	/**
	 * Clears Memory
	 */
	public function __destruct() {
		unset($this->invoiceNumber);
		unset($this->exportType);
		unset($this->exportTypeDescription);
		unset($this->termsOfTrade);
		unset($this->placeOfCommittal);
		unset($this->additionalFee);
		unset($this->permitNumber);
		unset($this->attestationNumber);
		unset($this->withElectronicExportNotification);
		unset($this->exportDocPosition);
	}

	/**
	 * @return float|int|null|string
	 */
	public function getInvoiceNumber() {
		return $this->invoiceNumber;
	}

	/**
	 * @param float|int|null|string $invoiceNumber
	 */
	public function setInvoiceNumber($invoiceNumber) {
		$this->invoiceNumber = $invoiceNumber;
	}

	/**
	 * @return string
	 */
	public function getExportType() {
		return $this->exportType;
	}

	/**
	 * @param string $exportType
	 */
	public function setExportType($exportType) {
		$this->exportType = $exportType;
	}

	/**
	 * @return null|string
	 */
	public function getExportTypeDescription() {
		return $this->exportTypeDescription;
	}

	/**
	 * @param null|string $exportTypeDescription
	 */
	public function setExportTypeDescription($exportTypeDescription) {
		$this->exportTypeDescription = $exportTypeDescription;
	}

	/**
	 * @return null|string
	 */
	public function getTermsOfTrade() {
		return $this->termsOfTrade;
	}

	/**
	 * @param null|string $termsOfTrade
	 */
	public function setTermsOfTrade($termsOfTrade) {
		$this->termsOfTrade = $termsOfTrade;
	}

	/**
	 * @return string
	 */
	public function getPlaceOfCommittal() {
		return $this->placeOfCommittal;
	}

	/**
	 * @param string $placeOfCommittal
	 */
	public function setPlaceOfCommittal($placeOfCommittal) {
		$this->placeOfCommittal = $placeOfCommittal;
	}

	/**
	 * @return float
	 */
	public function getAdditionalFee() {
		return $this->additionalFee;
	}

	/**
	 * @param float $additionalFee
	 */
	public function setAdditionalFee($additionalFee) {
		$this->additionalFee = $additionalFee;
	}

	/**
	 * @return float|int|null|string
	 */
	public function getPermitNumber() {
		return $this->permitNumber;
	}

	/**
	 * @param float|int|null|string $permitNumber
	 */
	public function setPermitNumber($permitNumber) {
		$this->permitNumber = $permitNumber;
	}

	/**
	 * @return float|int|null|string
	 */
	public function getAttestationNumber() {
		return $this->attestationNumber;
	}

	/**
	 * @param float|int|null|string $attestationNumber
	 */
	public function setAttestationNumber($attestationNumber) {
		$this->attestationNumber = $attestationNumber;
	}

	/**
	 * @return bool|null
	 */
	public function getWithElectronicExportNotification() {
		return $this->withElectronicExportNotification;
	}

	/**
	 * @param bool|null $withElectronicExportNotification
	 */
	public function setWithElectronicExportNotification($withElectronicExportNotification) {
		$this->withElectronicExportNotification = $withElectronicExportNotification;
	}

	/**
	 * @return ExportDocPosition|array|null
	 */
	public function getExportDocPosition() {
		return $this->exportDocPosition;
	}

	/**
	 * @param ExportDocPosition|array|null $exportDocPosition
	 */
	public function setExportDocPosition($exportDocPosition) {
		$this->exportDocPosition = $exportDocPosition;
	}

	/**
	 * Adds an ExportDocPosition-Object to the current Object
	 *
	 * If the ExportDocPosition was null before, then it will add the entry normal (backwards compatibility)
	 * If the ExportDocPosition was an array before, it just add it to the array
	 * If the ExportDocPosition was just 1 entry before, it will converted to an array with both entries
	 *
	 * @param ExportDocPosition $exportDocPosition - Object to add
	 */
	public function addExportDocPosition($exportDocPosition) {
		if($this->getExportDocPosition() === null)
			$this->setExportDocPosition($exportDocPosition);
		else if(is_array($this->getExportDocPosition()))
			$this->exportDocPosition[] = $exportDocPosition;
		else {
			// Convert the first existing entry to an array
			$this->setExportDocPosition(array($this->getExportDocPosition(), $exportDocPosition));
		}
	}

	/**
	 * @return StdClass
	 */
	public function getExportDocumentClass_v1() {
		$class = new StdClass;

		// todo implement

		return $class;
	}

	/**
	 * Returns a Class for Export-Document
	 *
	 * @return StdClass - DHL-ExportDocument-Class
	 * @throws Exception - Invalid Data-Exception
	 */
	public function getExportDocumentClass_v2() {
		$class = new StdClass;

		// Standard-Export-Stuff
		if($this->getInvoiceNumber() !== null)
			$class->invoiceNumber = $this->getInvoiceNumber();

		$class->exportType = $this->getExportType();

		if($this->getExportTypeDescription() !== null)
			$class->exportTypeDescription = $this->getExportTypeDescription();
		else if($this->getExportType() === self::EXPORT_TYPE_OTHER)
			throw new Exception('ExportTypeDescription must filled out if Export-Type is OTHER! - ' .
				'Export-Class will not generated now');

		if($this->getTermsOfTrade() !== null)
			$class->termsOfTrade = $this->getTermsOfTrade();

		$class->placeOfCommital = $this->getPlaceOfCommittal();
		$class->additionalFee = $this->getAdditionalFee();

		if($this->getPermitNumber() !== null)
			$class->permitNumber = $this->getPermitNumber();

		if($this->getAttestationNumber() !== null)
			$class->attestationNumber = $this->getAttestationNumber();

		// Add rest (Elements)
		if($this->getWithElectronicExportNotification() !== null) {
			$class->WithElectronicExportNtfctn = new StdClass;
			$class->WithElectronicExportNtfctn->active = (int) $this->getWithElectronicExportNotification();
		}

		// Check if child-class is being used
		if($this->getExportDocPosition() !== null) {
			// Handle non-arrays... (Backward compatibility)
			if(! is_array($this->getExportDocPosition()))
				$class->ExportDocPosition = $this->getExportDocPosition()->getExportDocPositionClass_v2();
			else {
				$pos = $this->getExportDocPosition();
				foreach($pos as $key => &$exportDoc)
					$class->ExportDocPosition[$key] = $exportDoc->getExportDocPositionClass_v2();
			}
		}

		return $class;
	}
}
