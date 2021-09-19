<?php

namespace App\Http\Controllers;

use App\Models\OpsiPackageUpgrade;
use Illuminate\Http\Request;

class DataTotalCostController extends Controller
{
    public function GetDataTotalCostUpgrade(Request $request)
    {
        $dataupgrade = explode('/', $request->addupgrade);
        $hariurgent = $request->hariurgents;
        $hariextended = $request->hariextended;
        $subtotalcost = 0;
        $totalcost = 0;
        $subtotalfee = 0;
        $projectupgrade = 0;
        $totalhargaurgent = 0;
        $fee = 0;
        if ($request->addupgrade != '') {
            for ($i = 0; $i < count($dataupgrade); $i++) {
                $opsiupgrades = OpsiPackageUpgrade::where('id', $dataupgrade[$i])->first();
                if ($opsiupgrades->name == 'Urgent') {
                    if ($hariurgent == null) {
                        $totalhargaurgent = $opsiupgrades->harga * 1;
                    } else {
                        $totalhargaurgent = $opsiupgrades->harga * $hariurgent;
                    }
                    $projectupgrade += $totalhargaurgent;
                } elseif ($opsiupgrades->name == 'Extended') {
                    if ($hariextended == null) {
                        $totalhargaextended = $opsiupgrades->harga * 1;
                    } else {
                        $totalhargaextended = $opsiupgrades->harga * $hariextended;
                    }
                    $projectupgrade += $totalhargaextended;
                } else {
                    $projectupgrade += $opsiupgrades->harga;
                }
            }

            if ($request->discountcodes != 'Free Fee') {
                $subtotalfee = $request->selectedpackageprices + $projectupgrade;
                $fee = (15 / 100) * $subtotalfee;
            }

            $subtotalcost = $request->selectedpackageprices + $projectupgrade + $fee;

            if ($request->discountcodes == '') {
                $totalcost = $subtotalcost;
            } else {
                $totalcost = $subtotalcost - $request->discountcodes;
            }
        } else {
            if ($request->discountcodes != 'Free Fee') {
                $subtotalfee = $request->selectedpackageprices + $projectupgrade;
                $fee = (15 / 100) * $subtotalfee;
                $subtotalcost = $request->selectedpackageprices + $projectupgrade + $fee;
            }
            if ($request->discountcodes == '') {
                $totalcost = $subtotalcost;
            } else {
                $totalcost = $subtotalcost - $request->discountcodes;
            }
        }
        return response()->json([
            'projectupgrade' => $projectupgrade,
            'totalcost' => $totalcost,
            'subtotalcost' => $subtotalcost,
            'fee' => $fee,
            'totalhargaurgent' => $totalhargaurgent,
        ]);
    }
    public function GetDataTotalCostPack(Request $request)
    {
        $subtotalcost = 0;
        $totalcost = 0;
        $subtotalfee = 0;
        $projectupgrade = $request->projectupgrades;
        $fee = 0;

        if ($request->projectupgrades != '') {

            $subtotalfee = $request->selectedpackageprices;

            if ($request->discountcodes != 'Free Fee') {
                $fee = (15 / 100) * $subtotalfee;
            }

            $subtotalcost = $request->selectedpackageprices + $fee;

            if ($request->discountcodes == '') {
                $totalcost = $subtotalcost;
            } else {
                $totalcost = $subtotalcost - $request->discountcodes;
            }
        } else {

            $subtotalfee = $request->selectedpackageprices + $projectupgrade;

            if ($request->discountcodes != 'Free Fee') {
                $fee = (15 / 100) * $subtotalfee;
            }

            $subtotalcost = $request->selectedpackageprices + $projectupgrade + $fee;

            if ($request->discountcodes == '') {
                $totalcost = $subtotalcost;
            } else {
                $totalcost = $subtotalcost - $request->discountcodes;
            }
        }

        return response()->json([
            'projectupgrade' => $projectupgrade,
            'totalcost' => $totalcost,
            'subtotalcost' => $subtotalcost,
            'fee' => $fee,
            'discountcodes' => $request->discountcodes,

        ]);
    }
    public function GetDataTotalCostFreeFee(Request $request)
    {
        $subtotalcost = 0;
        $totalcost = 0;
        $projectupgrade = $request->projectupgrades;
        $fee = 0;

        if ($request->projectupgrades != '') {
            $subtotalcost = $request->selectedpackageprices + $fee;
        } else {
            $subtotalcost = $request->selectedpackageprices + $fee;
        }

        return response()->json([
            'projectupgrade' => $projectupgrade,
            'totalcost' => $totalcost,
            'subtotalcost' => $subtotalcost,

        ]);
    }

}
