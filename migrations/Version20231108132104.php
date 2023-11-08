<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108132104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car ADD title VARCHAR(255) NOT NULL, ADD year INT NOT NULL, ADD km INT NOT NULL, ADD fuel_type VARCHAR(255) NOT NULL, ADD price INT NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD color VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE comment ADD lastname VARCHAR(255) NOT NULL, ADD content VARCHAR(255) NOT NULL, ADD is_approved TINYINT(1) NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE contact ADD lastname VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD subject VARCHAR(255) NOT NULL, ADD message VARCHAR(255) NOT NULL, ADD phone_number VARCHAR(255) NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE equipment ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE features ADD width INT NOT NULL, ADD length INT NOT NULL, ADD height INT NOT NULL, ADD weight INT NOT NULL, ADD price_min INT NOT NULL, ADD price_max INT NOT NULL');
        $this->addSql('ALTER TABLE mark ADD mark INT NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE `option` ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE service ADD title VARCHAR(255) NOT NULL, ADD description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE user DROP created_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP lastname, DROP content, DROP is_approved, DROP created_at');
        $this->addSql('ALTER TABLE contact DROP lastname, DROP email, DROP subject, DROP message, DROP phone_number, DROP created_at');
        $this->addSql('ALTER TABLE car DROP title, DROP year, DROP km, DROP fuel_type, DROP price, DROP created_at, DROP color');
        $this->addSql('ALTER TABLE equipment DROP name');
        $this->addSql('ALTER TABLE features DROP width, DROP length, DROP height, DROP weight, DROP price_min, DROP price_max');
        $this->addSql('ALTER TABLE mark DROP mark, DROP created_at');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE service DROP title, DROP description');
        $this->addSql('ALTER TABLE `option` DROP name');
    }
}
