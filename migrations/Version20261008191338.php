<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261008191338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin ADD email VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) DEFAULT NULL, ADD code_premiere_connexion VARCHAR(6) DEFAULT NULL, ADD premiere_connexion TINYINT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76E7927C74 ON admin (email)');
        $this->addSql('ALTER TABLE medecin ADD email VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) DEFAULT NULL, ADD code_premiere_connexion VARCHAR(6) DEFAULT NULL, ADD premiere_connexion TINYINT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1BDA53C6E7927C74 ON medecin (email)');
        $this->addSql('ALTER TABLE patient ADD email VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) DEFAULT NULL, ADD code_premiere_connexion VARCHAR(6) DEFAULT NULL, ADD premiere_connexion TINYINT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1ADAD7EBE7927C74 ON patient (email)');
        $this->addSql('ALTER TABLE pers_admin ADD email VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) DEFAULT NULL, ADD code_premiere_connexion VARCHAR(6) DEFAULT NULL, ADD premiere_connexion TINYINT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_83363517E7927C74 ON pers_admin (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_880E0D76E7927C74 ON admin');
        $this->addSql('ALTER TABLE admin DROP email, DROP roles, DROP password, DROP code_premiere_connexion, DROP premiere_connexion');
        $this->addSql('DROP INDEX UNIQ_1BDA53C6E7927C74 ON medecin');
        $this->addSql('ALTER TABLE medecin DROP email, DROP roles, DROP password, DROP code_premiere_connexion, DROP premiere_connexion');
        $this->addSql('DROP INDEX UNIQ_1ADAD7EBE7927C74 ON patient');
        $this->addSql('ALTER TABLE patient DROP email, DROP roles, DROP password, DROP code_premiere_connexion, DROP premiere_connexion');
        $this->addSql('DROP INDEX UNIQ_83363517E7927C74 ON pers_admin');
        $this->addSql('ALTER TABLE pers_admin DROP email, DROP roles, DROP password, DROP code_premiere_connexion, DROP premiere_connexion');
    }
}
