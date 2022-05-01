# Todo

## Books

- Index
  - Posts per
  - Grid/Row toggle
  - Search (authors/books)
- Create
  - Manual addition  
- Edit/Update
  - Edit each model individually except authors
  - Edition -> edit -> save
  - Author is read only
  - Publisher is read only
- Delete

## Editions

- Only accessible from edit book view


## Authors

- Index (a-z, z-a)
    - Search
- Edit/Update
- NO Delete 
- NO Create (part of Add Book)

## Publishers

- Read only

## Search

- Authors
- Books

## Breadcrumbs

At the top of each page put breadcumbs for navigation.

i.e. [Home]('#') > [Books]('#') > Game of Thrones 

## Series (collections)

There is a `series` datapoint on the openlibrary API but it doesn't look helpful.
For instance, there are no formal identifiers, and the series name varies from 
work to work. The series can be found on the edition itself.

Example:
- https://openlibrary.org/books/OL3428556M.json
- https://openlibrary.org/books/OL7826549M.json

Thus, we're going to need a new feature.

### Series Feature Goals:
  
- A quick and easy method to add existing books in the library to a series
  collection
- This feature will allow a user to:
    - Create a series collection
        - Open a modal
        - Enter the name of a series
        - Store the Series in the DB
    - Add books to series
        - Search + Add
        - Add order ("This is book [   ] of the series.")
    - Display series
        - Update numbering (and thus sort)
        - Sort by collection order and allow for partials: 0.1, 0.5, etc.
    - Delete book from collection
    - Metadata about collection
        - Count
    - `series` table
        - `id`
        - `name`
    - `series_books` table
        - `series_books_id`
        - `book_id` (fk)
        - `series_id` (fk)
        - `order`
    - Series
      - Index 
        - `name`, `count` (tiny thumbnails)?
      - Show
      - Create
      - Edit/Update
      - Delete


## Landing Page

- Magnifying glass (on hover? always there?)
- Popular authors
- Popular genres?
- Statistics about the collection
    - Number of books
    - Number of authors
    - Number of pages
    - % hardcover/trade paperback/paperback
