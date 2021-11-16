<?php

namespace App\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Auth;
// use Laratrust\Laratrust;

class MenuFilter implements FilterInterface
{
    public function transform($item)
    {
        $user = Auth::user();
            
        if(isset($item['text'])){
            
            if($user->isAdmin()){
                if($item['text']=='Dasbor'){
                    return false;
                }
                if($item['text']=='Data Mitra'){
                    return false;
                }
                if($item['text']=='Data Farm'){
                    return false;
                }
                if($item['text']=='Data Siklus'){
                    return false;
                }
                if($item['text']=='Data Konsumsi Pakan'){
                    return false;
                }
                if($item['text']=='Data Konsumsi Minum'){
                    return false;
                }
                if($item['text']=='Data Berat Ayam'){
                    return false;
                }
                if($item['text']=='Data Vitamin'){
                    return false;
                }
                if($item['text']=='Data Kematian'){
                    return false;
                }
                if($item['text']=='Beranda'){
                    return false;
                }
                if($item['text']=='Ternak'){
                    return false;
                }
                if($item['text']=='Siklus'){
                    return false;
                }
                if($item['text']=='Konsumsi Pakan'){
                    return false;
                }
                if($item['text']=='Konsumsi Minum'){
                    return false;
                }
                if($item['text']=='Berat Ayam'){
                    return false;
                }
                if($item['text']=='Vitamin'){
                    return false;
                }
                if($item['text']=='Kematian'){
                    return false;
                }
                if($item['text']=='Update Harian'){
                    return false;
                }
            }

            if($user->isPjub()){
                if($item['text']=='Beranda'){
                    return false;
                }
                if($item['text']=='Ternak'){
                    return false;
                }
                if($item['text']=='Siklus'){
                    return false;
                }
                if($item['text']=='Konsumsi Pakan'){
                    return false;
                }
                if($item['text']=='Konsumsi Minum'){
                    return false;
                }
                if($item['text']=='Berat Ayam'){
                    return false;
                }
                if($item['text']=='Vitamin'){
                    return false;
                }
                if($item['text']=='Kematian'){
                    return false;
                }
                if($item['text']=='Update Harian'){
                    return false;
                }
                if($item['text']=='DATA MASTER'){
                    return false;
                }elseif ($item['text']=='Dashboard') {
                    return false;
                }elseif ($item['text']=='DATA OPERASIONAL'){
                    return false;
                }elseif ($item['text']=='Update Harian'){
                    return false;
                }
            }
            
            if($user->isMitra()){
                if($item['text']=='Dasbor'){
                    return false;
                }
                if($item['text']=='Data Mitra'){
                    return false;
                }
                if($item['text']=='Data Farm'){
                    return false;
                }
                if($item['text']=='Data Siklus'){
                    return false;
                }
                if($item['text']=='Data Konsumsi Pakan'){
                    return false;
                }
                if($item['text']=='Data Konsumsi Minum'){
                    return false;
                }
                if($item['text']=='Data Berat Ayam'){
                    return false;
                }
                if($item['text']=='Data Vitamin'){
                    return false;
                }
                if($item['text']=='Data Kematian'){
                    return false;
                }
                if($item['text']=='DATA MASTER'){
                    return false;
                }elseif ($item['text']=='DATA OPERASIONAL') {
                    return false;
                }elseif ($item['text']=='Dashboard') {
                    return false;
                }elseif ($item['text']=='DATA OPERASIONAL'){
                    return false;
                }elseif ($item['text']=='Mitra'){
                    return false;
                }
            }


        }
                // die;
            // if($item['text']=='DATA MASTER'){
            //     var_dump($item);
            //     var_dump($user);
        
            //     die;
            // }
        return $item;
    }
}
