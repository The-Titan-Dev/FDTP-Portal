<?php

namespace App\Interfaces;

interface ContactInterface
{
    public function loadAllContacts();

    public function getSpecificContacts($id);

    public function storeContacts($request);

    public function updateContacts($request, $id);

    public function deleteContacts($id);
}