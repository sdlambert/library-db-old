<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewBook extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO Set up auth!!!
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // authors
            'authors.*.birth_date'    => 'nullable|string',
            'authors.*.death_date'    => 'nullable|string',
            'authors.*.first_name'    => 'required|string',
            'authors.*.last_name'     => 'nullable|string',
            'authors.*.ol_author_key' => 'required|string',
            //pseudonym?

            // publishers
            'publisher.name'          => 'required|string',

            // edition
            'edition.isbn_10'         => 'required_if:edition.isbn13,null|nullable|string', // must allow nullable
            'edition.isbn_13'         => 'required_if:edition.isbn10,null|nullable|string', // must allow nullable
            'edition.goodreads'       => 'nullable|string',
            'edition.ol_edition_key'  => 'nullable|string',
            'edition.publish_date'    => 'nullable|string',
            'edition.format'          => 'nullable|string',
            'edition.pages'           => 'nullable|integer',

            // book
            'book.title'              => 'required|string',
            'book.blurb'              => 'nullable|string',
            'book.url'                => 'nullable|url',
            'book.cover'              => 'nullable|url',
            'book.ol_work_key'        => 'nullable|string',
        ];
    }
}
