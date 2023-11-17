<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116195908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car_features DROP FOREIGN KEY FK_30F6E917C3C6F69F');
        $this->addSql('ALTER TABLE car_features DROP FOREIGN KEY FK_30F6E917CEC89005');
        $this->addSql('DROP TABLE car_features');
        $this->addSql('DROP TABLE features');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car_features (car_id INT NOT NULL, features_id INT NOT NULL, INDEX IDX_30F6E917CEC89005 (features_id), INDEX IDX_30F6E917C3C6F69F (car_id), PRIMARY KEY(car_id, features_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE features (id INT AUTO_INCREMENT NOT NULL, width INT NOT NULL, length INT NOT NULL, height INT NOT NULL, weight INT NOT NULL, price_min INT NOT NULL, price_max INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE car_features ADD CONSTRAINT FK_30F6E917C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car_features ADD CONSTRAINT FK_30F6E917CEC89005 FOREIGN KEY (features_id) REFERENCES features (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
