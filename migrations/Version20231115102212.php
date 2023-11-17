<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115102212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE schedule ADD opening_time_morning VARCHAR(255) DEFAULT NULL, ADD closing_time_morning VARCHAR(255) DEFAULT NULL, DROP opening_time_midday, DROP closing_time_midday');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE schedule ADD opening_time_midday VARCHAR(255) DEFAULT NULL, ADD closing_time_midday VARCHAR(255) DEFAULT NULL, DROP opening_time_morning, DROP closing_time_morning');
    }
}
