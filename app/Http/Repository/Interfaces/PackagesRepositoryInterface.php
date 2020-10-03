<?php

namespace App\Http\Repository\Interfaces;

interface PackagesRepositoryInterface
{
    public function GetAllPackages($request, $paginateSize);

    public function StorePackage($request);

    public function UpdatePackage($request, $package);

    public function DeletePackage($package);


}//END OF INTERFACE
