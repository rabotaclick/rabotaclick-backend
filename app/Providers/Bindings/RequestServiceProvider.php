<?php declare(strict_types=1);
namespace App\Providers\Bindings;

// Admin
use App\Http\Requests\Admin\Contracts\AuthRequestInterface as AdminAuthRequestInterface;
use App\Http\Requests\Admin\AuthRequest as AdminAuthRequest;
// Auth
use App\Http\Requests\Auth\Contracts\AuthRequestInterface;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\Contracts\LoginPasswordRequestInterface;
use App\Http\Requests\Auth\Contracts\LoginRequestInterface;
use App\Http\Requests\Auth\Contracts\RegisterRequestInterface as ApplicantRegisterRequestInterface;
use App\Http\Requests\Auth\LoginPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest as ApplicantRegisterRequest;
// Auth Employer
use App\Http\Requests\Auth\Employer\RegisterRequest as EmployerRegisterRequest;
use App\Http\Requests\Auth\Employer\Contracts\RegisterRequestInterface as EmployerRegisterRequestInterface;
use App\Http\Requests\Auth\Employer\FinishRegisterRequest as EmployerFinishRegisterRequest;
use App\Http\Requests\Auth\Employer\Contracts\FinishRegisterRequestInterface as EmployerFinishRegisterRequestInterface;
use App\Http\Requests\Auth\Employer\LoginRequest as EmployerLoginRequest;
use App\Http\Requests\Auth\Employer\Contracts\LoginRequestInterface as EmployerLoginRequestInterface;
// Company
use App\Http\Requests\Company\StoreRequest as CompanyStoreRequest;
use App\Http\Requests\Company\Contracts\StoreRequestInterface as CompanyStoreRequestInterface;
use App\Http\Requests\Company\UpdateRequest as CompanyUpdateRequest;
use App\Http\Requests\Company\Contracts\UpdateRequestInterface as CompanyUpdateRequestInterface;
use App\Http\Requests\Company\UpdatePhotoRequest as CompanyUpdatePhotoRequest;
use App\Http\Requests\Company\Contracts\UpdatePhotoRequestInterface as CompanyUpdatePhotoRequestInterface;
// City
use App\Http\Requests\City\Contracts\IndexRequestInterface as CityIndexRequestInterface;
use App\Http\Requests\City\IndexRequest as CityIndexRequest;
// Resume
use App\Http\Requests\Resume\Contracts\StoreRequestInterface as ResumeStoreRequestInterface;
use App\Http\Requests\Resume\Contracts\UpdateContactsRequestInterface as ResumeUpdateContactsRequestInterface;
use App\Http\Requests\Resume\Contracts\UpdatePersonalRequestInterface as ResumeUpdatePersonalRequestInterface;
use App\Http\Requests\Resume\Contracts\UpdateProfessionRequestInterface as ResumeUpdateProfessionRequestInterface;
use App\Http\Requests\Resume\StoreRequest as ResumeStoreRequest;
use App\Http\Requests\Resume\UpdateContactsRequest as ResumeUpdateContactsRequest;
use App\Http\Requests\Resume\UpdatePersonalRequest as ResumeUpdatePersonalRequest;
use App\Http\Requests\Resume\UpdateProfessionRequest as ResumeUpdateProfessionRequest;
use App\Http\Requests\Resume\Contracts\UpdateWorkingHistoryRequestInterface as ResumeUpdateWorkingHistoryRequestInterface;
use App\Http\Requests\Resume\UpdateWorkingHistoryRequest as ResumeUpdateWorkingHistoryRequest;
use App\Http\Requests\Resume\Contracts\UpdateEducationRequestInterface as ResumeUpdateEducationRequestInterface;
use App\Http\Requests\Resume\UpdateEducationRequest as ResumeUpdateEducationRequest;
use App\Http\Requests\Resume\Contracts\UpdateLanguagesRequestInterface as ResumeUpdateLanguagesRequestInterface;
use App\Http\Requests\Resume\UpdateLanguagesRequest as ResumeUpdateLanguagesRequest;
use App\Http\Requests\Resume\Contracts\UpdatePhotoRequestInterface as ResumeUpdatePhotoRequestInterface;
use App\Http\Requests\Resume\UpdatePhotoRequest as ResumeUpdatePhotoRequest;
use App\Http\Requests\Resume\Contracts\IndexRequestInterface as ResumeIndexRequestInterface;
use App\Http\Requests\Resume\IndexRequest as ResumeIndexRequest;
// Vacancy
use App\Http\Requests\Vacancy\Contracts\StoreRequestInterface as VacancyStoreRequestInterface;
use App\Http\Requests\Vacancy\StoreRequest as VacancyStoreRequest;
use App\Http\Requests\Vacancy\Contracts\IndexRequestInterface as VacancyIndexRequestInterface;
use App\Http\Requests\Vacancy\IndexRequest as VacancyIndexRequest;
use App\Http\Requests\Vacancy\Contracts\UpdateRequestInterface as VacancyUpdateRequestInterface;
use App\Http\Requests\Vacancy\UpdateRequest as VacancyUpdateRequest;
// CloudPayments
use App\Http\Requests\WebHook\CloudPayments\Contracts\CheckRequestInterface as CloudPaymentsCheckRequestInterface;
use App\Http\Requests\WebHook\CloudPayments\CheckRequest as CloudPaymentsCheckRequest;
use App\Http\Requests\WebHook\CloudPayments\Contracts\PayRequestInterface as CloudPaymentsPayRequestInterface;
use App\Http\Requests\WebHook\CloudPayments\PayRequest as CloudPaymentsPayRequest;
// UserEmployer
use App\Http\Requests\UserEmployer\UpdateRequest as UserEmployerUpdateRequest;
use App\Http\Requests\UserEmployer\Contracts\UpdateRequestInterface as UserEmployerUpdateRequestInterface;
// User
use App\Http\Requests\User\Contracts\UpdatePhoneRequestInterface as UserUpdatePhoneRequestInterface;
use App\Http\Requests\User\Contracts\UpdateRequestInterface as UserUpdateRequestInterface;
use App\Http\Requests\User\UpdatePhoneRequest as UserUpdatePhoneRequest;
use App\Http\Requests\User\UpdateRequest as UserUpdateRequest;
// Specialization
use App\Http\Requests\Specialization\Contracts\IndexRequestInterface as SpecializationIndexRequestInterface;
use App\Http\Requests\Specialization\IndexRequest as SpecializationIndexRequest;
use Illuminate\Support\ServiceProvider;
// SubSpecialization
use App\Http\Requests\SubSpecialization\Contracts\IndexRequestInterface as SubSpecializationIndexRequestInterface;
use App\Http\Requests\SubSpecialization\IndexRequest as SubSpecializationIndexRequest;
// Storage
use App\Http\Requests\Storage\Contracts\PutRequestInterface;
use App\Http\Requests\Storage\PutRequest;
// KeySkill
use App\Http\Requests\KeySkill\Contracts\IndexRequestInterface as KeySkillIndexRequestInterface;
use App\Http\Requests\KeySkill\IndexRequest as KeySkillIndexRequest;
// Language
use App\Http\Requests\Language\Contracts\IndexRequestInterface as LanguageIndexRequestInterface;
use App\Http\Requests\Language\IndexRequest as LanguageIndexRequest;
// Region
use App\Http\Requests\Region\Contracts\IndexRequestInterface as RegionIndexRequestInterface;
use App\Http\Requests\Region\IndexRequest as RegionIndexRequest;
// Country
use App\Http\Requests\Country\Contracts\IndexRequestInterface as CountryIndexRequestInterface;
use App\Http\Requests\Country\IndexRequest as CountryIndexRequest;

class RequestServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Admin requests
        $this->app->bind(AdminAuthRequestInterface::class, AdminAuthRequest::class);
        // Auth requests
        $this->app->bind(AuthRequestInterface::class, AuthRequest::class);
        $this->app->bind(LoginRequestInterface::class, LoginRequest::class);
        $this->app->bind(ApplicantRegisterRequestInterface::class, ApplicantRegisterRequest::class);
        $this->app->bind(LoginPasswordRequestInterface::class, LoginPasswordRequest::class);
        // Auth Employers requests
        $this->app->bind(EmployerRegisterRequestInterface::class, EmployerRegisterRequest::class);
        $this->app->bind(EmployerFinishRegisterRequestInterface::class, EmployerFinishRegisterRequest::class);
        $this->app->bind(EmployerLoginRequestInterface::class, EmployerLoginRequest::class);
        // Company requests
        $this->app->bind(CompanyStoreRequestInterface::class, CompanyStoreRequest::class);
        $this->app->bind(CompanyUpdateRequestInterface::class, CompanyUpdateRequest::class);
        $this->app->bind(CompanyUpdatePhotoRequestInterface::class, CompanyUpdatePhotoRequest::class);
        // Specialization requests
        $this->app->bind(SpecializationIndexRequestInterface::class, SpecializationIndexRequest::class);
        // SubSpecialization requests
        $this->app->bind(SubSpecializationIndexRequestInterface::class, SubSpecializationIndexRequest::class);
        // UserEmployer requests
        $this->app->bind(UserEmployerUpdateRequestInterface::class, UserEmployerUpdateRequest::class);
        // User requests
        $this->app->bind(UserUpdateRequestInterface::class, UserUpdateRequest::class);
        $this->app->bind(UserUpdatePhoneRequestInterface::class, UserUpdatePhoneRequest::class);
        // Resume requests
        $this->app->bind(ResumeStoreRequestInterface::class, ResumeStoreRequest::class);
        $this->app->bind(ResumeUpdatePersonalRequestInterface::class, ResumeUpdatePersonalRequest::class);
        $this->app->bind(ResumeUpdateContactsRequestInterface::class, ResumeUpdateContactsRequest::class);
        $this->app->bind(ResumeUpdateProfessionRequestInterface::class, ResumeUpdateProfessionRequest::class);
        $this->app->bind(ResumeUpdateWorkingHistoryRequestInterface::class, ResumeUpdateWorkingHistoryRequest::class);
        $this->app->bind(ResumeUpdateEducationRequestInterface::class, ResumeUpdateEducationRequest::class);
        $this->app->bind(ResumeUpdateLanguagesRequestInterface::class, ResumeUpdateLanguagesRequest::class);
        $this->app->bind(ResumeUpdatePhotoRequestInterface::class, ResumeUpdatePhotoRequest::class);
        $this->app->bind(ResumeIndexRequestInterface::class, ResumeIndexRequest::class);
        // Vacancy requests
        $this->app->bind(VacancyStoreRequestInterface::class, VacancyStoreRequest::class);
        $this->app->bind(VacancyIndexRequestInterface::class, VacancyIndexRequest::class);
        $this->app->bind(VacancyUpdateRequestInterface::class, VacancyUpdateRequest::class);
        // CloudPayments requests
        $this->app->bind(CloudPaymentsCheckRequestInterface::class, CloudPaymentsCheckRequest::class);
        $this->app->bind(CloudPaymentsPayRequestInterface::class, CloudPaymentsPayRequest::class);
        // City requests
        $this->app->bind(CityIndexRequestInterface::class, CityIndexRequest::class);
        // Storage requests
        $this->app->bind(PutRequestInterface::class, PutRequest::class);
        // KeySkill requests
        $this->app->bind(KeySkillIndexRequestInterface::class, KeySkillIndexRequest::class);
        // Language requests
        $this->app->bind(LanguageIndexRequestInterface::class, LanguageIndexRequest::class);
        // Region requests
        $this->app->bind(RegionIndexRequestInterface::class, RegionIndexRequest::class);
        // Country requests
        $this->app->bind(CountryIndexRequestInterface::class, CountryIndexRequest::class);
    }
}
