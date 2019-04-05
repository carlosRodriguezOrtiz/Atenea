<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190403180034 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE empresa (id INT AUTO_INCREMENT NOT NULL, corporaciones_id INT DEFAULT NULL, nombre VARCHAR(255) DEFAULT NULL, fecha_alta DATETIME DEFAULT NULL, fecha_baja DATETIME DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, INDEX IDX_B8D75A50CDCE378D (corporaciones_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, empresa_id INT DEFAULT NULL, role_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_8D93D649521E1991 (empresa_id), INDEX IDX_8D93D649D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rol (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE corporacion (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, fecha_alta DATETIME DEFAULT NULL, fecha_baja DATETIME DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE centro (id INT AUTO_INCREMENT NOT NULL, empresas_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, fecha_alta DATETIME NOT NULL, fecha_baja DATETIME NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, usuarios INT DEFAULT NULL, INDEX IDX_2675036B602B00EE (empresas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trabajador (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellido VARCHAR(255) NOT NULL, dni VARCHAR(255) NOT NULL, num_seg INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE macroentorno (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE empresa ADD CONSTRAINT FK_B8D75A50CDCE378D FOREIGN KEY (corporaciones_id) REFERENCES corporacion (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES rol (id)');
        $this->addSql('ALTER TABLE centro ADD CONSTRAINT FK_2675036B602B00EE FOREIGN KEY (empresas_id) REFERENCES empresa (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649521E1991');
        $this->addSql('ALTER TABLE centro DROP FOREIGN KEY FK_2675036B602B00EE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE empresa DROP FOREIGN KEY FK_B8D75A50CDCE378D');
        $this->addSql('DROP TABLE empresa');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE rol');
        $this->addSql('DROP TABLE corporacion');
        $this->addSql('DROP TABLE centro');
        $this->addSql('DROP TABLE trabajador');
        $this->addSql('DROP TABLE macroentorno');
    }
}
