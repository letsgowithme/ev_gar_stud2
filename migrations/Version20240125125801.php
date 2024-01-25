<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240125125801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment CHANGE subject subject VARCHAR(50) NOT NULL, CHANGE content content TINYTEXT NOT NULL, CHANGE author author VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE contact CHANGE contacter contacter VARCHAR(50) NOT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE subject subject VARCHAR(50) NOT NULL, CHANGE message message TEXT NOT NULL');
        $this->addSql('ALTER TABLE `option` CHANGE name name VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment CHANGE subject subject VARCHAR(255) NOT NULL, CHANGE content content VARCHAR(255) NOT NULL, CHANGE author author VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE contact CHANGE contacter contacter VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE subject subject VARCHAR(255) NOT NULL, CHANGE message message VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `option` CHANGE name name VARCHAR(255) NOT NULL');
    }
}
