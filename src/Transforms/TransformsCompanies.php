<?php

namespace TestMonitor\Custify\Transforms;

use TestMonitor\Custify\Validator;
use TestMonitor\Custify\Resources\Company;
use TestMonitor\Custify\Resources\CustomAttributes;

trait TransformsCompanies
{
    /**
     * @param array $companies
     *
     * @throws \TestMonitor\Custify\Exceptions\InvalidDataException
     * @return \TestMonitor\Custify\Resources\Company[]
     */
    protected function fromCustifyCompanies($companies): array
    {
        Validator::isArray($companies);

        return array_map(function ($company) {
            return $this->fromCustifyCompany($company);
        }, $companies);
    }

    /**
     * @param array $company
     *
     * @throws \TestMonitor\Custify\Exceptions\InvalidDataException
     * @return \TestMonitor\Custify\Resources\Company
     */
    protected function fromCustifyCompany($company): Company
    {
        Validator::keysExists($company, ['id', 'company_id']);

        return new Company([
            'id' => $company['id'],
            'company_id' => $company['company_id'],
            'name' => $company['name'],
            'website' => $company['website'] ?? null,
            'industry' => $company['industry'] ?? null,
            'size' => $company['size'] ?? null,
            'plan' => $company['plan'] ?? null,
            'churned' => $company['churned'] ?? null,
            'ownersAccount' => $company['owners_account'] ?? null,
            'ownersCsm' => $company['owners_csm'] ?? null,

            'custom_attributes' => new CustomAttributes($company['custom_attributes'] ?? []),
        ]);
    }

    /**
     * @param Company $company
     *
     * @return array
     */
    protected function toCustifyCompany(Company $company): array
    {
        return [
            'company_id' => $company->company_id,
            'name' => $company->name,
            'website' => $company->website,
            'industry' => $company->industry,
            'size' => $company->size,
            'plan' => $company->plan,
            'churned' => $company->churned,
            'owners_account' => $company->ownersAccount,
            'owners_csm' => $company->ownersCsm,

            'custom_attributes' => $company->customAttributes->toArray(),
        ];
    }
}
