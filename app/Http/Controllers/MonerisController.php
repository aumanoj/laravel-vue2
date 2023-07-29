<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Models\BrandContent;
use App\Models\Models;
use App\Models\ModelContent;
use App\Models\Network;
use App\Models\CustomPriceTool;
use App\Models\TblOrder;
use App\Models\TblOrderDetail;
use App\Models\Brand;
use App\Models\Tool;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Moneris\mpgGlobals;
use App\Moneris\httpsPost;
use App\Moneris\mpgHttpsPost;
use App\Moneris\mpgHttpsPostStatus;
use App\Moneris\mpgResponse;
use App\Moneris\mpgRequest;
use App\Moneris\mpgCustInfo;
use App\Moneris\mpgRecur;
use App\Moneris\mpgCvdInfo;
use App\Moneris\mpgAvsInfo;
use App\Moneris\mpgConvFeeInfo;
use App\Moneris\mpgTransaction;
use App\Moneris\MpiHttpsPost;
use App\Moneris\MpiResponse;
use App\Moneris\MpiRequest;
use App\Moneris\MpiTransaction;
use App\Moneris\riskHttpsPost;
use App\Moneris\riskResponse;
use App\Moneris\riskRequest;
use App\Moneris\mpgSessionAccountInfo;
use App\Moneris\mpgAttributeAccountInfo;
use App\Moneris\riskTransaction;
use App\Moneris\mpgAxLevel23;
use App\Moneris\axN1Loop;
use App\Moneris\axRef;
use App\Moneris\axIt1Loop;
use App\Moneris\axIt106s;
use App\Moneris\axTxi;
use App\Moneris\mpgAxRaLevel23;
use App\Moneris\mpgVsLevel23;
use App\Moneris\vsPurcha;
use App\Moneris\vsPurchl;
use App\Moneris\vsCorpai;
use App\Moneris\vsCorpas;
use App\Moneris\vsTripLegInfo;
use App\Moneris\mpgMcLevel23;
use App\Moneris\mcCorpac;
use App\Moneris\mcCorpai;
use App\Moneris\mcCorpas;
use App\Moneris\mcCorpal;
use App\Moneris\mcCorpar;
use App\Moneris\mcTax;

class MonerisController extends Controller
{
    //
}
