<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 21,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 22,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 23,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 24,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 25,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 26,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 27,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 28,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 29,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 30,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 31,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 32,
                'title' => 'car_rental_access',
            ],
            [
                'id'    => 33,
                'title' => 'car_create',
            ],
            [
                'id'    => 34,
                'title' => 'car_edit',
            ],
            [
                'id'    => 35,
                'title' => 'car_show',
            ],
            [
                'id'    => 36,
                'title' => 'car_delete',
            ],
            [
                'id'    => 37,
                'title' => 'car_access',
            ],
            [
                'id'    => 38,
                'title' => 'car_rental_contact_request_create',
            ],
            [
                'id'    => 39,
                'title' => 'car_rental_contact_request_edit',
            ],
            [
                'id'    => 40,
                'title' => 'car_rental_contact_request_show',
            ],
            [
                'id'    => 41,
                'title' => 'car_rental_contact_request_delete',
            ],
            [
                'id'    => 42,
                'title' => 'car_rental_contact_request_access',
            ],
            [
                'id'    => 43,
                'title' => 'home_page_access',
            ],
            [
                'id'    => 44,
                'title' => 'hero_banner_create',
            ],
            [
                'id'    => 45,
                'title' => 'hero_banner_edit',
            ],
            [
                'id'    => 46,
                'title' => 'hero_banner_show',
            ],
            [
                'id'    => 47,
                'title' => 'hero_banner_delete',
            ],
            [
                'id'    => 48,
                'title' => 'hero_banner_access',
            ],
            [
                'id'    => 49,
                'title' => 'home_info_create',
            ],
            [
                'id'    => 50,
                'title' => 'home_info_edit',
            ],
            [
                'id'    => 51,
                'title' => 'home_info_show',
            ],
            [
                'id'    => 52,
                'title' => 'home_info_delete',
            ],
            [
                'id'    => 53,
                'title' => 'home_info_access',
            ],
            [
                'id'    => 54,
                'title' => 'activity_create',
            ],
            [
                'id'    => 55,
                'title' => 'activity_edit',
            ],
            [
                'id'    => 56,
                'title' => 'activity_show',
            ],
            [
                'id'    => 57,
                'title' => 'activity_delete',
            ],
            [
                'id'    => 58,
                'title' => 'activity_access',
            ],
            [
                'id'    => 59,
                'title' => 'testimonial_create',
            ],
            [
                'id'    => 60,
                'title' => 'testimonial_edit',
            ],
            [
                'id'    => 61,
                'title' => 'testimonial_show',
            ],
            [
                'id'    => 62,
                'title' => 'testimonial_delete',
            ],
            [
                'id'    => 63,
                'title' => 'testimonial_access',
            ],
            [
                'id'    => 64,
                'title' => 'menu_own_car_access',
            ],
            [
                'id'    => 65,
                'title' => 'own_car_create',
            ],
            [
                'id'    => 66,
                'title' => 'own_car_edit',
            ],
            [
                'id'    => 67,
                'title' => 'own_car_show',
            ],
            [
                'id'    => 68,
                'title' => 'own_car_delete',
            ],
            [
                'id'    => 69,
                'title' => 'own_car_access',
            ],
            [
                'id'    => 70,
                'title' => 'own_car_form_create',
            ],
            [
                'id'    => 71,
                'title' => 'own_car_form_edit',
            ],
            [
                'id'    => 72,
                'title' => 'own_car_form_show',
            ],
            [
                'id'    => 73,
                'title' => 'own_car_form_delete',
            ],
            [
                'id'    => 74,
                'title' => 'own_car_form_access',
            ],
            [
                'id'    => 75,
                'title' => 'menu_stand_access',
            ],
            [
                'id'    => 76,
                'title' => 'fuel_create',
            ],
            [
                'id'    => 77,
                'title' => 'fuel_edit',
            ],
            [
                'id'    => 78,
                'title' => 'fuel_show',
            ],
            [
                'id'    => 79,
                'title' => 'fuel_delete',
            ],
            [
                'id'    => 80,
                'title' => 'fuel_access',
            ],
            [
                'id'    => 81,
                'title' => 'month_create',
            ],
            [
                'id'    => 82,
                'title' => 'month_edit',
            ],
            [
                'id'    => 83,
                'title' => 'month_show',
            ],
            [
                'id'    => 84,
                'title' => 'month_delete',
            ],
            [
                'id'    => 85,
                'title' => 'month_access',
            ],
            [
                'id'    => 86,
                'title' => 'origin_create',
            ],
            [
                'id'    => 87,
                'title' => 'origin_edit',
            ],
            [
                'id'    => 88,
                'title' => 'origin_show',
            ],
            [
                'id'    => 89,
                'title' => 'origin_delete',
            ],
            [
                'id'    => 90,
                'title' => 'origin_access',
            ],
            [
                'id'    => 91,
                'title' => 'stand_item_access',
            ],
            [
                'id'    => 92,
                'title' => 'stand_car_create',
            ],
            [
                'id'    => 93,
                'title' => 'stand_car_edit',
            ],
            [
                'id'    => 94,
                'title' => 'stand_car_show',
            ],
            [
                'id'    => 95,
                'title' => 'stand_car_delete',
            ],
            [
                'id'    => 96,
                'title' => 'stand_car_access',
            ],
            [
                'id'    => 97,
                'title' => 'status_create',
            ],
            [
                'id'    => 98,
                'title' => 'status_edit',
            ],
            [
                'id'    => 99,
                'title' => 'status_show',
            ],
            [
                'id'    => 100,
                'title' => 'status_delete',
            ],
            [
                'id'    => 101,
                'title' => 'status_access',
            ],
            [
                'id'    => 102,
                'title' => 'menu_courier_access',
            ],
            [
                'id'    => 103,
                'title' => 'courier_create',
            ],
            [
                'id'    => 104,
                'title' => 'courier_edit',
            ],
            [
                'id'    => 105,
                'title' => 'courier_show',
            ],
            [
                'id'    => 106,
                'title' => 'courier_delete',
            ],
            [
                'id'    => 107,
                'title' => 'courier_access',
            ],
            [
                'id'    => 108,
                'title' => 'courier_form_create',
            ],
            [
                'id'    => 109,
                'title' => 'courier_form_edit',
            ],
            [
                'id'    => 110,
                'title' => 'courier_form_show',
            ],
            [
                'id'    => 111,
                'title' => 'courier_form_delete',
            ],
            [
                'id'    => 112,
                'title' => 'courier_form_access',
            ],
            [
                'id'    => 113,
                'title' => 'menu_training_access',
            ],
            [
                'id'    => 114,
                'title' => 'training_create',
            ],
            [
                'id'    => 115,
                'title' => 'training_edit',
            ],
            [
                'id'    => 116,
                'title' => 'training_show',
            ],
            [
                'id'    => 117,
                'title' => 'training_delete',
            ],
            [
                'id'    => 118,
                'title' => 'training_access',
            ],
            [
                'id'    => 119,
                'title' => 'training_form_create',
            ],
            [
                'id'    => 120,
                'title' => 'training_form_edit',
            ],
            [
                'id'    => 121,
                'title' => 'training_form_show',
            ],
            [
                'id'    => 122,
                'title' => 'training_form_delete',
            ],
            [
                'id'    => 123,
                'title' => 'training_form_access',
            ],
            [
                'id'    => 124,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 125,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 126,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 127,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 128,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 129,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 130,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 131,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 132,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 133,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 134,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 135,
                'title' => 'product_create',
            ],
            [
                'id'    => 136,
                'title' => 'product_edit',
            ],
            [
                'id'    => 137,
                'title' => 'product_show',
            ],
            [
                'id'    => 138,
                'title' => 'product_delete',
            ],
            [
                'id'    => 139,
                'title' => 'product_access',
            ],
            [
                'id'    => 140,
                'title' => 'menu_tranfer_tour_access',
            ],
            [
                'id'    => 141,
                'title' => 'product_form_create',
            ],
            [
                'id'    => 142,
                'title' => 'product_form_edit',
            ],
            [
                'id'    => 143,
                'title' => 'product_form_show',
            ],
            [
                'id'    => 144,
                'title' => 'product_form_delete',
            ],
            [
                'id'    => 145,
                'title' => 'product_form_access',
            ],
            [
                'id'    => 146,
                'title' => 'transfer_form_create',
            ],
            [
                'id'    => 147,
                'title' => 'transfer_form_edit',
            ],
            [
                'id'    => 148,
                'title' => 'transfer_form_show',
            ],
            [
                'id'    => 149,
                'title' => 'transfer_form_delete',
            ],
            [
                'id'    => 150,
                'title' => 'transfer_form_access',
            ],
            [
                'id'    => 151,
                'title' => 'menu_consulting_access',
            ],
            [
                'id'    => 152,
                'title' => 'consulting_create',
            ],
            [
                'id'    => 153,
                'title' => 'consulting_edit',
            ],
            [
                'id'    => 154,
                'title' => 'consulting_show',
            ],
            [
                'id'    => 155,
                'title' => 'consulting_delete',
            ],
            [
                'id'    => 156,
                'title' => 'consulting_access',
            ],
            [
                'id'    => 157,
                'title' => 'consulting_form_create',
            ],
            [
                'id'    => 158,
                'title' => 'consulting_form_edit',
            ],
            [
                'id'    => 159,
                'title' => 'consulting_form_show',
            ],
            [
                'id'    => 160,
                'title' => 'consulting_form_delete',
            ],
            [
                'id'    => 161,
                'title' => 'consulting_form_access',
            ],
            [
                'id'    => 162,
                'title' => 'newsletter_create',
            ],
            [
                'id'    => 163,
                'title' => 'newsletter_edit',
            ],
            [
                'id'    => 164,
                'title' => 'newsletter_show',
            ],
            [
                'id'    => 165,
                'title' => 'newsletter_delete',
            ],
            [
                'id'    => 166,
                'title' => 'newsletter_access',
            ],
            [
                'id'    => 167,
                'title' => 'brand_create',
            ],
            [
                'id'    => 168,
                'title' => 'brand_edit',
            ],
            [
                'id'    => 169,
                'title' => 'brand_show',
            ],
            [
                'id'    => 170,
                'title' => 'brand_delete',
            ],
            [
                'id'    => 171,
                'title' => 'brand_access',
            ],
            [
                'id'    => 172,
                'title' => 'car_model_create',
            ],
            [
                'id'    => 173,
                'title' => 'car_model_edit',
            ],
            [
                'id'    => 174,
                'title' => 'car_model_show',
            ],
            [
                'id'    => 175,
                'title' => 'car_model_delete',
            ],
            [
                'id'    => 176,
                'title' => 'car_model_access',
            ],
            [
                'id'    => 177,
                'title' => 'page_create',
            ],
            [
                'id'    => 178,
                'title' => 'page_edit',
            ],
            [
                'id'    => 179,
                'title' => 'page_show',
            ],
            [
                'id'    => 180,
                'title' => 'page_delete',
            ],
            [
                'id'    => 181,
                'title' => 'page_access',
            ],
            [
                'id'    => 182,
                'title' => 'legal_create',
            ],
            [
                'id'    => 183,
                'title' => 'legal_edit',
            ],
            [
                'id'    => 184,
                'title' => 'legal_show',
            ],
            [
                'id'    => 185,
                'title' => 'legal_delete',
            ],
            [
                'id'    => 186,
                'title' => 'legal_access',
            ],
            [
                'id'    => 187,
                'title' => 'page_menu_access',
            ],
            [
                'id'    => 188,
                'title' => 'page_form_create',
            ],
            [
                'id'    => 189,
                'title' => 'page_form_edit',
            ],
            [
                'id'    => 190,
                'title' => 'page_form_show',
            ],
            [
                'id'    => 191,
                'title' => 'page_form_delete',
            ],
            [
                'id'    => 192,
                'title' => 'page_form_access',
            ],
            [
                'id'    => 193,
                'title' => 'transfer_tour_create',
            ],
            [
                'id'    => 194,
                'title' => 'transfer_tour_edit',
            ],
            [
                'id'    => 195,
                'title' => 'transfer_tour_show',
            ],
            [
                'id'    => 196,
                'title' => 'transfer_tour_delete',
            ],
            [
                'id'    => 197,
                'title' => 'transfer_tour_access',
            ],
            [
                'id'    => 198,
                'title' => 'transmission_create',
            ],
            [
                'id'    => 199,
                'title' => 'transmission_edit',
            ],
            [
                'id'    => 200,
                'title' => 'transmission_show',
            ],
            [
                'id'    => 201,
                'title' => 'transmission_delete',
            ],
            [
                'id'    => 202,
                'title' => 'transmission_access',
            ],
            [
                'id'    => 203,
                'title' => 'stand_car_form_create',
            ],
            [
                'id'    => 204,
                'title' => 'stand_car_form_edit',
            ],
            [
                'id'    => 205,
                'title' => 'stand_car_form_show',
            ],
            [
                'id'    => 206,
                'title' => 'stand_car_form_delete',
            ],
            [
                'id'    => 207,
                'title' => 'stand_car_form_access',
            ],
            [
                'id'    => 208,
                'title' => 'tvde_access',
            ],
            [
                'id'    => 209,
                'title' => 'driver_create',
            ],
            [
                'id'    => 210,
                'title' => 'driver_edit',
            ],
            [
                'id'    => 211,
                'title' => 'driver_show',
            ],
            [
                'id'    => 212,
                'title' => 'driver_delete',
            ],
            [
                'id'    => 213,
                'title' => 'driver_access',
            ],
            [
                'id'    => 214,
                'title' => 'card_create',
            ],
            [
                'id'    => 215,
                'title' => 'card_edit',
            ],
            [
                'id'    => 216,
                'title' => 'card_show',
            ],
            [
                'id'    => 217,
                'title' => 'card_delete',
            ],
            [
                'id'    => 218,
                'title' => 'card_access',
            ],
            [
                'id'    => 219,
                'title' => 'operation_create',
            ],
            [
                'id'    => 220,
                'title' => 'operation_edit',
            ],
            [
                'id'    => 221,
                'title' => 'operation_show',
            ],
            [
                'id'    => 222,
                'title' => 'operation_delete',
            ],
            [
                'id'    => 223,
                'title' => 'operation_access',
            ],
            [
                'id'    => 224,
                'title' => 'local_create',
            ],
            [
                'id'    => 225,
                'title' => 'local_edit',
            ],
            [
                'id'    => 226,
                'title' => 'local_show',
            ],
            [
                'id'    => 227,
                'title' => 'local_delete',
            ],
            [
                'id'    => 228,
                'title' => 'local_access',
            ],
            [
                'id'    => 229,
                'title' => 'state_create',
            ],
            [
                'id'    => 230,
                'title' => 'state_edit',
            ],
            [
                'id'    => 231,
                'title' => 'state_show',
            ],
            [
                'id'    => 232,
                'title' => 'state_delete',
            ],
            [
                'id'    => 233,
                'title' => 'state_access',
            ],
            [
                'id'    => 234,
                'title' => 'tvde_config_access',
            ],
            [
                'id'    => 235,
                'title' => 'tvde_year_create',
            ],
            [
                'id'    => 236,
                'title' => 'tvde_year_edit',
            ],
            [
                'id'    => 237,
                'title' => 'tvde_year_show',
            ],
            [
                'id'    => 238,
                'title' => 'tvde_year_delete',
            ],
            [
                'id'    => 239,
                'title' => 'tvde_year_access',
            ],
            [
                'id'    => 240,
                'title' => 'tvde_month_create',
            ],
            [
                'id'    => 241,
                'title' => 'tvde_month_edit',
            ],
            [
                'id'    => 242,
                'title' => 'tvde_month_show',
            ],
            [
                'id'    => 243,
                'title' => 'tvde_month_delete',
            ],
            [
                'id'    => 244,
                'title' => 'tvde_month_access',
            ],
            [
                'id'    => 245,
                'title' => 'tvde_week_create',
            ],
            [
                'id'    => 246,
                'title' => 'tvde_week_edit',
            ],
            [
                'id'    => 247,
                'title' => 'tvde_week_show',
            ],
            [
                'id'    => 248,
                'title' => 'tvde_week_delete',
            ],
            [
                'id'    => 249,
                'title' => 'tvde_week_access',
            ],
            [
                'id'    => 250,
                'title' => 'tvde_operator_create',
            ],
            [
                'id'    => 251,
                'title' => 'tvde_operator_edit',
            ],
            [
                'id'    => 252,
                'title' => 'tvde_operator_show',
            ],
            [
                'id'    => 253,
                'title' => 'tvde_operator_delete',
            ],
            [
                'id'    => 254,
                'title' => 'tvde_operator_access',
            ],
            [
                'id'    => 255,
                'title' => 'activity_launch_create',
            ],
            [
                'id'    => 256,
                'title' => 'activity_launch_edit',
            ],
            [
                'id'    => 257,
                'title' => 'activity_launch_show',
            ],
            [
                'id'    => 258,
                'title' => 'activity_launch_delete',
            ],
            [
                'id'    => 259,
                'title' => 'activity_launch_access',
            ],
            [
                'id'    => 260,
                'title' => 'activity_per_operator_create',
            ],
            [
                'id'    => 261,
                'title' => 'activity_per_operator_edit',
            ],
            [
                'id'    => 262,
                'title' => 'activity_per_operator_show',
            ],
            [
                'id'    => 263,
                'title' => 'activity_per_operator_delete',
            ],
            [
                'id'    => 264,
                'title' => 'activity_per_operator_access',
            ],
            [
                'id'    => 265,
                'title' => 'activity_management_access',
            ],
            [
                'id'    => 266,
                'title' => 'tvde_driver_management_create',
            ],
            [
                'id'    => 267,
                'title' => 'tvde_driver_management_edit',
            ],
            [
                'id'    => 268,
                'title' => 'tvde_driver_management_show',
            ],
            [
                'id'    => 269,
                'title' => 'tvde_driver_management_delete',
            ],
            [
                'id'    => 270,
                'title' => 'tvde_driver_management_access',
            ],
            [
                'id'    => 271,
                'title' => 'payouts_to_driver_create',
            ],
            [
                'id'    => 272,
                'title' => 'payouts_to_driver_edit',
            ],
            [
                'id'    => 273,
                'title' => 'payouts_to_driver_show',
            ],
            [
                'id'    => 274,
                'title' => 'payouts_to_driver_delete',
            ],
            [
                'id'    => 275,
                'title' => 'payouts_to_driver_access',
            ],
            [
                'id'    => 276,
                'title' => 'drivers_balance_create',
            ],
            [
                'id'    => 277,
                'title' => 'drivers_balance_edit',
            ],
            [
                'id'    => 278,
                'title' => 'drivers_balance_show',
            ],
            [
                'id'    => 279,
                'title' => 'drivers_balance_delete',
            ],
            [
                'id'    => 280,
                'title' => 'drivers_balance_access',
            ],
            [
                'id'    => 281,
                'title' => 'document_create',
            ],
            [
                'id'    => 282,
                'title' => 'document_edit',
            ],
            [
                'id'    => 283,
                'title' => 'document_show',
            ],
            [
                'id'    => 284,
                'title' => 'document_delete',
            ],
            [
                'id'    => 285,
                'title' => 'document_access',
            ],
            [
                'id'    => 286,
                'title' => 'my_document_create',
            ],
            [
                'id'    => 287,
                'title' => 'my_document_edit',
            ],
            [
                'id'    => 288,
                'title' => 'my_document_show',
            ],
            [
                'id'    => 289,
                'title' => 'my_document_delete',
            ],
            [
                'id'    => 290,
                'title' => 'my_document_access',
            ],
            [
                'id'    => 291,
                'title' => 'financial_statement_create',
            ],
            [
                'id'    => 292,
                'title' => 'financial_statement_edit',
            ],
            [
                'id'    => 293,
                'title' => 'financial_statement_show',
            ],
            [
                'id'    => 294,
                'title' => 'financial_statement_delete',
            ],
            [
                'id'    => 295,
                'title' => 'financial_statement_access',
            ],
            [
                'id'    => 296,
                'title' => 'receipt_create',
            ],
            [
                'id'    => 297,
                'title' => 'receipt_edit',
            ],
            [
                'id'    => 298,
                'title' => 'receipt_show',
            ],
            [
                'id'    => 299,
                'title' => 'receipt_delete',
            ],
            [
                'id'    => 300,
                'title' => 'receipt_access',
            ],
            [
                'id'    => 301,
                'title' => 'my_receipt_create',
            ],
            [
                'id'    => 302,
                'title' => 'my_receipt_edit',
            ],
            [
                'id'    => 303,
                'title' => 'my_receipt_show',
            ],
            [
                'id'    => 304,
                'title' => 'my_receipt_delete',
            ],
            [
                'id'    => 305,
                'title' => 'my_receipt_access',
            ],
            [
                'id'    => 306,
                'title' => 'company_document_create',
            ],
            [
                'id'    => 307,
                'title' => 'company_document_edit',
            ],
            [
                'id'    => 308,
                'title' => 'company_document_show',
            ],
            [
                'id'    => 309,
                'title' => 'company_document_delete',
            ],
            [
                'id'    => 310,
                'title' => 'company_document_access',
            ],
            [
                'id'    => 311,
                'title' => 'website_access',
            ],
            [
                'id'    => 312,
                'title' => 'statement_of_responsibility_create',
            ],
            [
                'id'    => 313,
                'title' => 'statement_of_responsibility_edit',
            ],
            [
                'id'    => 314,
                'title' => 'statement_of_responsibility_show',
            ],
            [
                'id'    => 315,
                'title' => 'statement_of_responsibility_delete',
            ],
            [
                'id'    => 316,
                'title' => 'statement_of_responsibility_access',
            ],
            [
                'id'    => 317,
                'title' => 'contracts_menu_access',
            ],
            [
                'id'    => 318,
                'title' => 'contract_create',
            ],
            [
                'id'    => 319,
                'title' => 'contract_edit',
            ],
            [
                'id'    => 320,
                'title' => 'contract_show',
            ],
            [
                'id'    => 321,
                'title' => 'contract_delete',
            ],
            [
                'id'    => 322,
                'title' => 'contract_access',
            ],
            [
                'id'    => 323,
                'title' => 'admin_statement_responsibility_create',
            ],
            [
                'id'    => 324,
                'title' => 'admin_statement_responsibility_edit',
            ],
            [
                'id'    => 325,
                'title' => 'admin_statement_responsibility_show',
            ],
            [
                'id'    => 326,
                'title' => 'admin_statement_responsibility_delete',
            ],
            [
                'id'    => 327,
                'title' => 'admin_statement_responsibility_access',
            ],
            [
                'id'    => 328,
                'title' => 'admin_contract_create',
            ],
            [
                'id'    => 329,
                'title' => 'admin_contract_edit',
            ],
            [
                'id'    => 330,
                'title' => 'admin_contract_show',
            ],
            [
                'id'    => 331,
                'title' => 'admin_contract_delete',
            ],
            [
                'id'    => 332,
                'title' => 'admin_contract_access',
            ],
            [
                'id'    => 333,
                'title' => 'vehicle_access',
            ],
            [
                'id'    => 334,
                'title' => 'vehicle_brand_create',
            ],
            [
                'id'    => 335,
                'title' => 'vehicle_brand_edit',
            ],
            [
                'id'    => 336,
                'title' => 'vehicle_brand_show',
            ],
            [
                'id'    => 337,
                'title' => 'vehicle_brand_delete',
            ],
            [
                'id'    => 338,
                'title' => 'vehicle_brand_access',
            ],
            [
                'id'    => 339,
                'title' => 'vehicle_model_create',
            ],
            [
                'id'    => 340,
                'title' => 'vehicle_model_edit',
            ],
            [
                'id'    => 341,
                'title' => 'vehicle_model_show',
            ],
            [
                'id'    => 342,
                'title' => 'vehicle_model_delete',
            ],
            [
                'id'    => 343,
                'title' => 'vehicle_model_access',
            ],
            [
                'id'    => 344,
                'title' => 'vehicle_event_type_create',
            ],
            [
                'id'    => 345,
                'title' => 'vehicle_event_type_edit',
            ],
            [
                'id'    => 346,
                'title' => 'vehicle_event_type_show',
            ],
            [
                'id'    => 347,
                'title' => 'vehicle_event_type_delete',
            ],
            [
                'id'    => 348,
                'title' => 'vehicle_event_type_access',
            ],
            [
                'id'    => 349,
                'title' => 'vehicle_event_warning_time_create',
            ],
            [
                'id'    => 350,
                'title' => 'vehicle_event_warning_time_edit',
            ],
            [
                'id'    => 351,
                'title' => 'vehicle_event_warning_time_show',
            ],
            [
                'id'    => 352,
                'title' => 'vehicle_event_warning_time_delete',
            ],
            [
                'id'    => 353,
                'title' => 'vehicle_event_warning_time_access',
            ],
            [
                'id'    => 354,
                'title' => 'vehicle_setting_access',
            ],
            [
                'id'    => 355,
                'title' => 'vehicle_event_create',
            ],
            [
                'id'    => 356,
                'title' => 'vehicle_event_edit',
            ],
            [
                'id'    => 357,
                'title' => 'vehicle_event_show',
            ],
            [
                'id'    => 358,
                'title' => 'vehicle_event_delete',
            ],
            [
                'id'    => 359,
                'title' => 'vehicle_event_access',
            ],
            [
                'id'    => 360,
                'title' => 'vehicle_item_create',
            ],
            [
                'id'    => 361,
                'title' => 'vehicle_item_edit',
            ],
            [
                'id'    => 362,
                'title' => 'vehicle_item_show',
            ],
            [
                'id'    => 363,
                'title' => 'vehicle_item_delete',
            ],
            [
                'id'    => 364,
                'title' => 'vehicle_item_access',
            ],
            [
                'id'    => 365,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
