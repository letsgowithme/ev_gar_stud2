<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231109094748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car ADD modele_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DAC14B70A FOREIGN KEY (modele_id) REFERENCES modeles (id)');
        $this->addSql('CREATE INDEX IDX_773DE69DAC14B70A ON car (modele_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DAC14B70A');
        $this->addSql('DROP INDEX IDX_773DE69DAC14B70A ON car');
        $this->addSql('ALTER TABLE car DROP modele_id');
    }
}
