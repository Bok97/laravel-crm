<?php

namespace App\Http\Services;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CompanyService
{
    public function getCompanies($perPage = 10, $search = null, $sort = 'desc')
    {
        $query = Company::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        $sort = strtolower($sort) == 'asc' ? 'asc' : 'desc';
        $query->orderBy('created_at', $sort);

        return $query->paginate($perPage);
    }

    public function getCompanyById($id)
    {
        return Company::findOrFail($id);
    }

    public function createCompany($data)
    {
        if (isset($data['logo'])) {
            $data['logo'] = $this->saveLogoImage($data['logo']);
        }

        return Company::create($data);
    }

    public function updateCompany($id, $data)
    {
        $company = Company::findOrFail($id);

        if (isset($data['logo'])) {
            $data['logo'] = $this->saveLogoImage($data['logo']);
        }

        $company->update($data);

        return $company;
    }

    public function deleteCompany($id)
    {
        try {
            $company = Company::find($id);
            if (!$company) {
                return false;
            }
            if ($company->logo) {
                Storage::delete('public/' . $company->logo);
            }
            $company->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function saveLogoImage($image)
    {
        $imageInstance = Image::make($image);

        if ($imageInstance->width() < 100 || $imageInstance->height() < 100) {
            throw new \Exception('Image dimensions are too small.');
        }

        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = 'logos/' . $filename;

        Storage::disk('public')->put($path, $image->get());

        return $path;
    }

    public function getLatestCompanies($limit = 10)
    {
        return Company::latest()->take($limit)->get();
    }
}
