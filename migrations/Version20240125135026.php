<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240125135026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE schedule CHANGE opening_time_morning opening_time_morning VARCHAR(10) DEFAULT NULL, CHANGE closing_time_morning closing_time_morning VARCHAR(10) DEFAULT NULL, CHANGE opening_time_evening opening_time_evening VARCHAR(10) DEFAULT NULL, CHANGE closing_time_evening closing_time_evening VARCHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE schedule CHANGE opening_time_morning opening_time_morning VARCHAR(255) DEFAULT NULL, CHANGE closing_time_morning closing_time_morning VARCHAR(255) DEFAULT NULL, CHANGE opening_time_evening opening_time_evening VARCHAR(255) DEFAULT NULL, CHANGE closing_time_evening closing_time_evening VARCHAR(255) DEFAULT NULL');
    }
}
