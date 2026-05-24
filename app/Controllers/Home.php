<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function belajar_segment()
    {
        $uri = service('uri');
        $parameter1 = $uri->getSegment(3);
        $parameter2 = $uri->getSegment(4);
        $parameter3 = $uri->getSegment(5);


        $data['p1'] = $parameter1;
        $data['p2'] = $parameter2;
        $data['p3'] = $parameter3;

        return view('segment_view', $data);
    }
    public function cek_nilai($nilai)
    {
        if ($nilai >= 80) {
            $grade = 'A';
        } elseif ($nilai >= 60) {
            $grade = 'B';
        } elseif ($nilai >= 40) {
            $grade = 'C';
        } else {
            $grade = 'D';
        }

        $data = [
            'nilai' => $nilai,
            'grade' => $grade
        ];

        return view('nilai_view', $data);
    }

    public function cek_nilai_loop($nilai)
    {
        $data = [];

        for ($i = 0; $i < 5; $i++) {
            $n = $nilai + ($i * 2); // beda: naik 2

            if ($n >= 85) {
                $grade = 'A';
            } elseif ($n >= 70) {
                $grade = 'B';
            } elseif ($n >= 50) {
                $grade = 'C';
            } else {
                $grade = 'D';
            }

            // tambahan baru
            if ($n >= 60) {
                $status = 'Lulus';
            } else {
                $status = 'Tidak Lulus';
            }

            $data[] = [
                'nilai' => $n,
                'grade' => $grade,
                'status' => $status
            ];
        }

        return view('loop_view', ['data' => $data]);
    }
}
