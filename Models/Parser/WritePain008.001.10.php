<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\BankAccounting\Models\Parser
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

$payments = [];

$xml = <<<PAIN_START
<?xml version="1.0" encoding="UTF-8"?>
<Document xmlns="urn:iso:std:iso:20022:tech:xsd:pain.001.001.11" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <CstmrCdtTrfInitn>
        <GrpHdr>
            <MsgId>ABC123</MsgId>
            <CreDtTm>2023-06-07T10:30:00</CreDtTm>
            <NbOfTxs>1</NbOfTxs>
            <CtrlSum>123.45</CtrlSum>
            <InitgPty>
                <Nm>Mein Unternehmen</Nm>
            </InitgPty>
        </GrpHdr>
        <PmtInf>
            <PmtInfId>DEF456</PmtInfId>
            <PmtMtd>TRF</PmtMtd>
            <PmtTpInf><SvcLvl><Cd>SEPA</Cd></SvcLvl></PmtTpInf>
            <NbOfTxs>1</NbOfTxs>
            <ChrgBr>SLEV</ChrgBr>
            <CtrlSum>123.45</CtrlSum>
            <ReqdExctnDt><Dt>2023-06-08</Dt></ReqdExctnDt>
            <Dbtr>
                <Nm>Mein Unternehmen</Nm>
                <PstlAdr>
                    <StrtNm>Alt Karlo</StrtNm>
                    <BldgNb>31a</BldgNb>
                    <PstCd>3 OG</PstCd>
                    <TwnNm>Bayern</TwnNm>
                    <Ctry>DE</Ctry>
                </PstlAdr>
            </Dbtr>
            <DbtrAcct>
                <Id>
                    <IBAN>DE89370400440532013000</IBAN>
                </Id>
                <Ccy>EUR</Ccy>
            </DbtrAcct>
            <DbtrAgt>
                <FinInstnId>
                    <BICFI>COBADEFF370</BICFI>
                </FinInstnId>
            </DbtrAgt>
PAIN_START;

foreach ($payments as $payment) {
    $xml .= <<<PAIN_MAIN
            <CdtTrfTxInf>
                <PmtId>
                    <EndToEndId>ENDTOEND/1234567890</EndToEndId>
                </PmtId>
                <Amt>
                    <InstdAmt Ccy="EUR">123.45</InstdAmt>
                </Amt>
                <CdtrAgt>
                    <FinInstnId>
                        <BICFI>MARKDEFF370</BICFI>
                    </FinInstnId>
                </CdtrAgt>
                <Cdtr>
                    <Nm>Empfänger</Nm>
                </Cdtr>
                <CdtrAcct>
                    <Id>
                        <IBAN>DE93100000000123456789</IBAN>
                    </Id>
                </CdtrAcct>
                <RmtInf>
                    <Ustrd>Rechnung #123</Ustrd>
                </RmtInf>
            </CdtTrfTxInf>
PAIN_MAIN;

    // @question consider to use <Strd> instead of <Ustrd> where possible
    // @question consider to use <Invcr>
    // @question how to mix international pay?
}

$xml .= <<<PAIN_END
        </PmtInf>
    </CstmrCdtTrfInitn>
</Document>
PAIN_END;
