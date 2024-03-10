<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240310131214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admin` ADD lastname VARCHAR(30) NOT NULL, ADD firstname VARCHAR(30) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D763124B5B6 ON `admin` (lastname)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D7683A00E68 ON `admin` (firstname)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_880E0D763124B5B6 ON `admin`');
        $this->addSql('DROP INDEX UNIQ_880E0D7683A00E68 ON `admin`');
        $this->addSql('ALTER TABLE `admin` DROP lastname, DROP firstname');
    }
}
