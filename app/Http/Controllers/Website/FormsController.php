<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\CarRentalContactRequest;
use App\Models\ConsultingForm;
use App\Models\CourierForm;
use App\Models\Newsletter;
use App\Models\OwnCarForm;
use App\Models\PageForm;
use App\Models\StandCarForm;
use App\Models\TrainingForm;
use App\Models\TransferForm;
use Illuminate\Http\Request;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Notification;

class FormsController extends Controller
{
    public function newsletter(Request $request)
    {

        $request->validate([
            'email' => 'required|max:255|email|unique:App\Models\Newsletter,email'
        ], [], [
                'email' => 'Email.'
            ]);

        $newsletter = new Newsletter;
        $newsletter->email = $request->email;
        $newsletter->save();

        Notification::route('mail', 'info@expertcom.pt')
            ->notify(new \App\Notifications\Newsletter($newsletter));

    }

    public function carRentalContact(Request $request)
    {
        $request->validate([
            'city' => 'required|max:255',
            'email' => 'required|max:255|email',
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'rgpd' => 'required'
        ], [], [
                'city' => 'Cidade',
                'email' => 'Email',
                'name' => 'Nome',
                'phone' => 'Telefone',
                'rgpd' => 'Autorizo o tratamento dos dados fornecidos'
            ]);

        $CarRentalContactRequest = new CarRentalContactRequest;
        $CarRentalContactRequest->car_id = $request->car_id;
        $CarRentalContactRequest->name = $request->name;
        $CarRentalContactRequest->phone = $request->phone;
        $CarRentalContactRequest->email = $request->email;
        $CarRentalContactRequest->city = $request->city;
        if ($request->tvde) {
            $CarRentalContactRequest->tvde = 1;
        }
        $CarRentalContactRequest->tvde_card = $request->tvde_card;
        $CarRentalContactRequest->message = $request->message;
        $CarRentalContactRequest->rgpd = 1;
        $CarRentalContactRequest->save();

        Notification::route('mail', 'info@expertcom.pt')
            ->notify(new \App\Notifications\carRentalContact($CarRentalContactRequest));

    }

    public function ownCarContact(Request $request)
    {
        $request->validate([
            'city' => 'required|max:255',
            'email' => 'required|max:255|email',
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'rgpd' => 'required'
        ], [], [
                'city' => 'Cidade',
                'email' => 'Email',
                'name' => 'Nome',
                'phone' => 'Telefone',
                'rgpd' => 'Autorizo o tratamento dos dados fornecidos'
            ]);

        $OwnCarForm = new OwnCarForm;
        $OwnCarForm->name = $request->name;
        $OwnCarForm->phone = $request->phone;
        $OwnCarForm->email = $request->email;
        $OwnCarForm->city = $request->city;
        if ($request->tvde) {
            $OwnCarForm->tvde = 1;
        }
        $OwnCarForm->tvde_card = $request->tvde_card;
        $OwnCarForm->message = $request->message;
        $OwnCarForm->rgpd = 1;
        $OwnCarForm->save();

        Notification::route('mail', 'info@expertcom.pt')
            ->notify(new \App\Notifications\ownCarContact($OwnCarForm));
    }

    public function courierContact(Request $request)
    {
        $request->validate([
            'city' => 'required|max:255',
            'email' => 'required|max:255|email',
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'rgpd' => 'required'
        ], [], [
                'city' => 'Cidade',
                'email' => 'Email',
                'name' => 'Nome',
                'phone' => 'Telefone',
                'rgpd' => 'Autorizo o tratamento dos dados fornecidos'
            ]);

        $CourierForm = new CourierForm;
        $CourierForm->name = $request->name;
        $CourierForm->phone = $request->phone;
        $CourierForm->email = $request->email;
        $CourierForm->city = $request->city;
        if ($request->courier) {
            $CourierForm->courier = 1;
        }
        $CourierForm->account = $request->account;
        $CourierForm->rgpd = 1;
        $CourierForm->save();

        Notification::route('mail', 'info@expertcom.pt')
            ->notify(new \App\Notifications\courierContact($CourierForm));
    }

    public function trainingContact(Request $request)
    {
        $request->validate([
            'city' => 'required|max:255',
            'email' => 'required|max:255|email',
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'rgpd' => 'required'
        ], [], [
                'city' => 'Cidade',
                'email' => 'Email',
                'name' => 'Nome',
                'phone' => 'Telefone',
                'rgpd' => 'Autorizo o tratamento dos dados fornecidos'
            ]);

        $trainingForm = new TrainingForm;
        $trainingForm->name = $request->name;
        $trainingForm->phone = $request->phone;
        $trainingForm->email = $request->email;
        $trainingForm->city = $request->city;
        $trainingForm->rgpd = 1;
        $trainingForm->save();

        Notification::route('mail', 'info@expertcom.pt')
            ->notify(new \App\Notifications\trainingContact($trainingForm));
    }

    public function pageContact(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255|email',
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'rgpd' => 'required'
        ], [], [
                'email' => 'Email',
                'name' => 'Nome',
                'phone' => 'Telefone',
                'rgpd' => 'Autorizo o tratamento dos dados fornecidos'
            ]);

        $PageForm = new PageForm;
        $PageForm->name = $request->name;
        $PageForm->phone = $request->phone;
        $PageForm->email = $request->email;
        $PageForm->rgpd = 1;
        $PageForm->save();

        Notification::route('mail', 'info@expertcom.pt')
            ->notify(new \App\Notifications\pageContact($PageForm));
    }
    public function consultingContact(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255|email',
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'city' => 'required|max:255',
            'rgpd' => 'required'
        ], [], [
                'email' => 'Email',
                'name' => 'Nome',
                'phone' => 'Telefone',
                'city' => 'Cidade',
                'rgpd' => 'Autorizo o tratamento dos dados fornecidos'
            ]);

        $ConsultingForm = new ConsultingForm;
        $ConsultingForm->name = $request->name;
        $ConsultingForm->phone = $request->phone;
        $ConsultingForm->email = $request->email;
        $ConsultingForm->city = $request->city;
        $ConsultingForm->message = $request->message;
        $ConsultingForm->rgpd = 1;
        $ConsultingForm->save();

        Notification::route('mail', 'info@expertcom.pt')
            ->notify(new \App\Notifications\consultingContact($ConsultingForm));
    }

    public function transferTourContact(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255|email',
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'city' => 'required|max:255',
            'rgpd' => 'required'
        ], [], [
                'email' => 'Email',
                'name' => 'Nome',
                'phone' => 'Telefone',
                'city' => 'Cidade',
                'rgpd' => 'Autorizo o tratamento dos dados fornecidos'
            ]);

        $TransferForm = new TransferForm;
        $TransferForm->transfer_tour_id = $request->id;
        $TransferForm->name = $request->name;
        $TransferForm->phone = $request->phone;
        $TransferForm->email = $request->email;
        $TransferForm->city = $request->city;
        $TransferForm->message = $request->message;
        $TransferForm->rgpd = 1;
        $TransferForm->save();

        Notification::route('mail', 'info@expertcom.pt')
            ->notify(new \App\Notifications\transferTourContact($TransferForm));
    }

    public function standCarContact(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255|email',
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'rgpd' => 'required'
        ], [], [
                'email' => 'Email',
                'name' => 'Nome',
                'phone' => 'Telefone',
                'rgpd' => 'Autorizo o tratamento dos dados fornecidos'
            ]);

        $StandCarForm = new StandCarForm;
        $StandCarForm->car_id = $request->id;
        $StandCarForm->name = $request->name;
        $StandCarForm->phone = $request->phone;
        $StandCarForm->email = $request->email;
        $StandCarForm->message = $request->message;
        $StandCarForm->rgpd = 1;
        $StandCarForm->save();

        Notification::route('mail', 'info@expertcom.pt')
            ->notify(new \App\Notifications\standCarContact($StandCarForm));
    }
}