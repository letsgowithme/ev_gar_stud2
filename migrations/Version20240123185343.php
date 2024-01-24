<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123185343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car CHANGE title title VARCHAR(100) NOT NULL, CHANGE image_name image_name VARCHAR(100) DEFAULT NULL, CHANGE fuel_type fuel_type VARCHAR(50) NOT NULL, CHANGE color color VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE firstname firstname VARCHAR(50) NOT NULL, CHANGE lastname lastname VARCHAR(50) NOT NULL, CHANGE email email VARCHAR(30) NOT NULL, CHANGE password password VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE firstname firstname VARCHAR(255) NOT NULL, CHANGE lastname lastname VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE car CHANGE title title VARCHAR(255) NOT NULL, CHANGE image_name image_name VARCHAR(255) DEFAULT NULL, CHANGE fuel_type fuel_type VARCHAR(255) NOT NULL, CHANGE color color VARCHAR(255) NOT NULL');
    }
}
