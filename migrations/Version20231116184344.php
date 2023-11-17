<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116184344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car_features (car_id INT NOT NULL, features_id INT NOT NULL, INDEX IDX_30F6E917C3C6F69F (car_id), INDEX IDX_30F6E917CEC89005 (features_id), PRIMARY KEY(car_id, features_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car_features ADD CONSTRAINT FK_30F6E917C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car_features ADD CONSTRAINT FK_30F6E917CEC89005 FOREIGN KEY (features_id) REFERENCES features (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car_features DROP FOREIGN KEY FK_30F6E917C3C6F69F');
        $this->addSql('ALTER TABLE car_features DROP FOREIGN KEY FK_30F6E917CEC89005');
        $this->addSql('DROP TABLE car_features');
    }
}
