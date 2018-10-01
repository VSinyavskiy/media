<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;

class ExportsController extends Controller
{
    public function index()
    {
        $pageTitle = __('admin.exports.title');

        return view('admin.exports.index', compact('pageTitle'));
    }

    public function invited()
    {
        $filename  = 'invited_' . date('d-m-Y_H-i-s') . '.csv';
        $out       = fopen(public_path() . '/reports/invited/' . $filename, 'w');

        $invited = User::users()->confirmed()->whereNotNull('10th_friend_invited_at')->get();

        fwrite($out, "\xEF\xBB\xBF");
        fputcsv($out, [
            __('admin.users.fields.id'),
            __('admin.users.fields.first_name'),
            __('admin.users.fields.last_name'),
            __('admin.users.fields.phone'),
            __('admin.users.fields.email'),
            __('admin.users.fields.city'),
            __('admin.users.fields.total_points'),
            __('admin.users.fields.10th_friend_invited_at'),
            __('admin.users.fields.friend_invited_count'),
            __('admin.users.fields.created_at'),
        ], ';');

        foreach($invited as $invite) {
            fputcsv($out, [
                $invite->id,
                $invite->first_name,
                $invite->last_name,
                $invite->phone,
                $invite->email,
                $invite->city,
                $invite->total_points,
                $invite->{'10th_friend_invited_at'},
                $invite->invited_count,
                $invite->created_at->format('d.m.Y'),
            ], ';');
        }

        fclose($out);

        header('Location: ' . asset('reports/invited/' . $filename));
        header("Cache-Control: public");
        header('Content-Description: File Transfer');
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: ' . filesize(public_path() . '/reports/invited/' . $filename));

        exit;
    }

    public function top(Request $request)
    {
        $this->validate($request, [
            'end_top'   => 'required|date',
        ]);

        $filename  = 'top_' . date('d-m-Y_H-i-s') . '.csv';
        $out       = fopen(public_path() . '/reports/top/' . $filename, 'w');
        $endDate   = getTimestampFromFormat('d/m/Y', $request->end_top)->endOfDay()->format('Y-m-d H:i:s');

        $tops = User::users()->confirmed()->where('updated_at', '<=', $endDate)->sortByTopTotalPoints()->limit(User::REPORTS_TOP_COUNT)->get();

        fwrite($out, "\xEF\xBB\xBF");
        fputcsv($out, [
            __('admin.users.fields.id'),
            __('admin.users.fields.first_name'),
            __('admin.users.fields.last_name'),
            __('admin.users.fields.phone'),
            __('admin.users.fields.email'),
            __('admin.users.fields.city'),
            __('admin.users.fields.total_points'),
            __('admin.users.fields.created_at'),
        ], ';');

        foreach($tops as $top) {
            fputcsv($out, [
                $top->id,
                $top->first_name,
                $top->last_name,
                $top->phone,
                $top->email,
                $top->city,
                $top->total_points,
                $top->created_at->format('d.m.Y'),
            ], ';');
        }

        fclose($out);

        header('Location: ' . asset('reports/top/' . $filename));
        header("Cache-Control: public");
        header('Content-Description: File Transfer');
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: ' . filesize(public_path() . '/reports/top/' . $filename));

        exit;
    }
}
