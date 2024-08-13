<?php

namespace App\Http\Controllers;

use App\Models\Ami;
use App\Models\Rtp;
use Illuminate\Http\Request;

class RtpController extends Controller
{
    public function store(Request $request, Ami $ami){
        $data_rtp = $request->input('rtp');

        if ($data_rtp !== null) {
            foreach ($data_rtp as $id_rtp => $rtp) {
                $rtp_sudah_ada = $ami->rtp()->find($id_rtp);

                if ($rtp_sudah_ada) {
                    $rtp_sudah_ada->temuan = $rtp['temuan'];
                    $rtp_sudah_ada->rtp = $rtp['rtp'];
                    $rtp_sudah_ada->penanggungjawab = $rtp['penanggungjawab'];
                    $rtp_sudah_ada->save();
                }
            }

            $data_rtp_dihapus = array_diff(
                $ami->rtp()->pluck('id')->toArray(),
                array_keys($data_rtp)
            );

            foreach ($data_rtp_dihapus as $id_rtp) {
                $ami->rtp()->where('id', $id_rtp)->delete();
            }
        }

        $data_rtp_baru = array_filter($request->input('rtp_baru'), function ($rtp) {
            return $rtp['temuan'] !== null
            && $rtp['rtp'] !== null
            && $rtp['penanggungjawab'] !== null;
        });

        if ($data_rtp_baru !== null) {
            // $ami->rtp()->createMany($data_rtp_baru);
            foreach ($data_rtp_baru as $rtp_baru) {
                // dd($rtp_baru);
                $ami->rtp()->create($rtp_baru);
            }
        }

        $link_lampiran = $request->input('link');

        if ($link_lampiran !== null) {
            $ami->lampiran()->delete();
            $ami->lampiran()->create([
                'link' => $link_lampiran
            ]);
        }

        return redirect()->route('lpm.ami.rtp', $ami);
    }
}
