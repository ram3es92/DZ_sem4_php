<?php
abstract class AbstractBook
{
    protected string $title;
    protected string $isbn;
    protected array $authors;
    protected string $releaseDate;
    protected string $preview;
    protected int $readCount = 0; // Учет прочтений

    public function incrementReadCount(): void
    {
        $this->readCount++;
    }

    public function getReadCount(): int
    {
        return $this->readCount;
    }

    abstract function recycleBook(): void;
    abstract function addBook(): void;
    abstract function getBook(): AbstractBook;
    abstract function returnBook(AbstractBook $book): void;
}

// Добавляем физическую книгу
class Book extends AbstractBook
{
    protected int $pageCount;
    protected string $libraryAddress; // Адрес библиотеки

    public function __construct(string $title, string $isbn, array $authors, string $releaseDate, string $preview, int $pageCount, string $libraryAddress)
    {
        $this->title = $title;
        $this->isbn = $isbn;
        $this->authors = $authors;
        $this->releaseDate = $releaseDate;
        $this->preview = $preview;
        $this->pageCount = $pageCount;
        $this->libraryAddress = $libraryAddress;
    }

    public function getBook(): Book
    {
        $this->incrementReadCount(); // Увеличиваем счетчик при получении книги
        return $this;
    }

    // Возвращаем физическую книгу
    public function returnBook(AbstractBook $book): void
    {
        // Логика учета возврата книги
        echo "Книга возвращена в библиотеку.\n";
    }

    // Получаем адрес библиотеки
    public function getLibraryAddress(): string
    {
        return $this->libraryAddress;
    }

    // Логика удаления книги
    public function recycleBook(): void
    {
        echo "Физическая книга удалена из библиотеки.\n";
    }

    // Логика добавления книги
    public function addBook(): void
    {
        echo "Физическая книга добавлена в библиотеку.\n";
    }
}

// Добавляем цифровую книгу
class DigitalBook extends AbstractBook
{
    private string $bookURL; // Ссылка для скачивания

    public function __construct(string $title, string $isbn, array $authors, string $releaseDate, string $preview, string $bookURL)
    {
        $this->title = $title;
        $this->isbn = $isbn;
        $this->authors = $authors;
        $this->releaseDate = $releaseDate;
        $this->preview = $preview;
        $this->bookURL = $bookURL;
    }

    public function getBook(): DigitalBook
    {
        $this->incrementReadCount(); // Увеличиваем счетчик при скачивании книги
        return $this;
    }

    public function getURL(): string
    {
        return $this->bookURL;
    }

    public function returnBook(AbstractBook $book): void
    {
        // Логика возврата цифровой книги (может быть учет лицензий или прав доступа)
        echo "Цифровая книга возвращена (лицензия обновлена).\n";
    }

    public function recycleBook(): void
    {
        echo "Цифровая книга удалена из системы.\n";
    }

    public function addBook(): void
    {
        echo "Цифровая книга добавлена в библиотеку.\n";
    }
}