<?php
namespace App\Enums;

enum UserTypeEnum: string {
    case ADMIN = "admin";
    case DOCTOR = "doctor";
    case PATIENT = "patient";
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
