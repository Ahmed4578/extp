<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240502141438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE analyse CHANGE nom nom VARCHAR(25) DEFAULT NULL, CHANGE type type VARCHAR(25) DEFAULT NULL, CHANGE date date DATE DEFAULT NULL, CHANGE valide valide VARCHAR(25) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient CHANGE nom nom VARCHAR(25) DEFAULT NULL, CHANGE prenom prenom VARCHAR(25) DEFAULT NULL, CHANGE date_de_naissance date_de_naissance DATE DEFAULT NULL, CHANGE adresse adresse VARCHAR(35) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE analyse CHANGE nom nom VARCHAR(25) DEFAULT \'NULL\', CHANGE type type VARCHAR(25) DEFAULT \'NULL\', CHANGE date date DATE DEFAULT \'NULL\', CHANGE valide valide VARCHAR(25) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE patient CHANGE nom nom VARCHAR(25) DEFAULT \'NULL\', CHANGE prenom prenom VARCHAR(25) DEFAULT \'NULL\', CHANGE date_de_naissance date_de_naissance DATE DEFAULT \'NULL\', CHANGE adresse adresse VARCHAR(35) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
