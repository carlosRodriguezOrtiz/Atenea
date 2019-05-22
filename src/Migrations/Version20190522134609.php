<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190522134609 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, empresa_id INT DEFAULT NULL, role_id INT DEFAULT NULL, corporacion_id INT DEFAULT NULL, centro_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_8D93D649521E1991 (empresa_id), INDEX IDX_8D93D649D60322AC (role_id), INDEX IDX_8D93D6491011F129 (corporacion_id), INDEX IDX_8D93D649298137A7 (centro_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aspecte_q (id INT AUTO_INCREMENT NOT NULL, cuestiones_externas_id INT DEFAULT NULL, cuestiones_internas_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, dafo VARCHAR(255) NOT NULL, alta DATETIME NOT NULL, baixa DATETIME NOT NULL, descripcio VARCHAR(255) NOT NULL, INDEX IDX_556D6A54DC2A6589 (cuestiones_externas_id), INDEX IDX_556D6A54FC8006E1 (cuestiones_internas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dafo_tipus_qi (id INT AUTO_INCREMENT NOT NULL, questio_interna_id INT DEFAULT NULL, id_dafo_id INT DEFAULT NULL, tipus VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_57AB589A7C92792A (questio_interna_id), INDEX IDX_57AB589A1397BB9D (id_dafo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions_externes (id INT AUTO_INCREMENT NOT NULL, subtipus_id INT DEFAULT NULL, empresa_id INT DEFAULT NULL, centro_id INT DEFAULT NULL, corporacion_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, fecha_alta DATETIME NOT NULL, fecha_baja DATETIME NOT NULL, INDEX IDX_C3428BEC821C8592 (subtipus_id), INDEX IDX_C3428BEC521E1991 (empresa_id), INDEX IDX_C3428BEC298137A7 (centro_id), INDEX IDX_C3428BEC1011F129 (corporacion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipus_qe (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dafo (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE corporacion (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, fecha_alta DATETIME DEFAULT NULL, fecha_baja DATETIME DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dafo_tipus_qe (id INT AUTO_INCREMENT NOT NULL, questio_externa_id INT DEFAULT NULL, id_dafo_id INT DEFAULT NULL, tipus VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_5E1D14B1B974A25F (questio_externa_id), INDEX IDX_5E1D14B11397BB9D (id_dafo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_tipus_qe (id INT AUTO_INCREMENT NOT NULL, tipus_qe_id INT DEFAULT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_C63F7E8D6D8F41FE (tipus_qe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE empresa (id INT AUTO_INCREMENT NOT NULL, corporaciones_id INT DEFAULT NULL, nombre VARCHAR(255) DEFAULT NULL, fecha_alta DATETIME DEFAULT NULL, fecha_baja DATETIME DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, INDEX IDX_B8D75A50CDCE378D (corporaciones_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions_internes (id INT AUTO_INCREMENT NOT NULL, tipus_id INT DEFAULT NULL, empresa_id INT DEFAULT NULL, centro_id INT DEFAULT NULL, corporacion_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, fecha_alta DATETIME NOT NULL, INDEX IDX_90E33757898C381B (tipus_id), INDEX IDX_90E33757521E1991 (empresa_id), INDEX IDX_90E33757298137A7 (centro_id), INDEX IDX_90E337571011F129 (corporacion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trabajador (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellido VARCHAR(255) NOT NULL, dni VARCHAR(255) NOT NULL, num_seg INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rol (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emergente (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factor_critico_de_exito (id INT AUTO_INCREMENT NOT NULL, binomio_id INT DEFAULT NULL, alta DATETIME DEFAULT NULL, baja DATETIME DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, nombre VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_753784AEA4CAF78E (binomio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE macroentorno (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE centro (id INT AUTO_INCREMENT NOT NULL, empresas_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, fecha_alta DATETIME NOT NULL, fecha_baja DATETIME NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, usuarios INT DEFAULT NULL, INDEX IDX_2675036B602B00EE (empresas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE binomio (id INT AUTO_INCREMENT NOT NULL, selected TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE binomio_aspecte_q (binomio_id INT NOT NULL, aspecte_q_id INT NOT NULL, INDEX IDX_3B7BFE1CA4CAF78E (binomio_id), INDEX IDX_3B7BFE1CA1E5DDC1 (aspecte_q_id), PRIMARY KEY(binomio_id, aspecte_q_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipus_qi (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES rol (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491011F129 FOREIGN KEY (corporacion_id) REFERENCES corporacion (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649298137A7 FOREIGN KEY (centro_id) REFERENCES centro (id)');
        $this->addSql('ALTER TABLE aspecte_q ADD CONSTRAINT FK_556D6A54DC2A6589 FOREIGN KEY (cuestiones_externas_id) REFERENCES questions_externes (id)');
        $this->addSql('ALTER TABLE aspecte_q ADD CONSTRAINT FK_556D6A54FC8006E1 FOREIGN KEY (cuestiones_internas_id) REFERENCES questions_internes (id)');
        $this->addSql('ALTER TABLE dafo_tipus_qi ADD CONSTRAINT FK_57AB589A7C92792A FOREIGN KEY (questio_interna_id) REFERENCES questions_internes (id)');
        $this->addSql('ALTER TABLE dafo_tipus_qi ADD CONSTRAINT FK_57AB589A1397BB9D FOREIGN KEY (id_dafo_id) REFERENCES dafo (id)');
        $this->addSql('ALTER TABLE questions_externes ADD CONSTRAINT FK_C3428BEC821C8592 FOREIGN KEY (subtipus_id) REFERENCES sub_tipus_qe (id)');
        $this->addSql('ALTER TABLE questions_externes ADD CONSTRAINT FK_C3428BEC521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)');
        $this->addSql('ALTER TABLE questions_externes ADD CONSTRAINT FK_C3428BEC298137A7 FOREIGN KEY (centro_id) REFERENCES centro (id)');
        $this->addSql('ALTER TABLE questions_externes ADD CONSTRAINT FK_C3428BEC1011F129 FOREIGN KEY (corporacion_id) REFERENCES corporacion (id)');
        $this->addSql('ALTER TABLE dafo_tipus_qe ADD CONSTRAINT FK_5E1D14B1B974A25F FOREIGN KEY (questio_externa_id) REFERENCES questions_externes (id)');
        $this->addSql('ALTER TABLE dafo_tipus_qe ADD CONSTRAINT FK_5E1D14B11397BB9D FOREIGN KEY (id_dafo_id) REFERENCES dafo (id)');
        $this->addSql('ALTER TABLE sub_tipus_qe ADD CONSTRAINT FK_C63F7E8D6D8F41FE FOREIGN KEY (tipus_qe_id) REFERENCES tipus_qe (id)');
        $this->addSql('ALTER TABLE empresa ADD CONSTRAINT FK_B8D75A50CDCE378D FOREIGN KEY (corporaciones_id) REFERENCES corporacion (id)');
        $this->addSql('ALTER TABLE questions_internes ADD CONSTRAINT FK_90E33757898C381B FOREIGN KEY (tipus_id) REFERENCES tipus_qi (id)');
        $this->addSql('ALTER TABLE questions_internes ADD CONSTRAINT FK_90E33757521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)');
        $this->addSql('ALTER TABLE questions_internes ADD CONSTRAINT FK_90E33757298137A7 FOREIGN KEY (centro_id) REFERENCES centro (id)');
        $this->addSql('ALTER TABLE questions_internes ADD CONSTRAINT FK_90E337571011F129 FOREIGN KEY (corporacion_id) REFERENCES corporacion (id)');
        $this->addSql('ALTER TABLE factor_critico_de_exito ADD CONSTRAINT FK_753784AEA4CAF78E FOREIGN KEY (binomio_id) REFERENCES binomio (id)');
        $this->addSql('ALTER TABLE centro ADD CONSTRAINT FK_2675036B602B00EE FOREIGN KEY (empresas_id) REFERENCES empresa (id)');
        $this->addSql('ALTER TABLE binomio_aspecte_q ADD CONSTRAINT FK_3B7BFE1CA4CAF78E FOREIGN KEY (binomio_id) REFERENCES binomio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE binomio_aspecte_q ADD CONSTRAINT FK_3B7BFE1CA1E5DDC1 FOREIGN KEY (aspecte_q_id) REFERENCES aspecte_q (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE binomio_aspecte_q DROP FOREIGN KEY FK_3B7BFE1CA1E5DDC1');
        $this->addSql('ALTER TABLE aspecte_q DROP FOREIGN KEY FK_556D6A54DC2A6589');
        $this->addSql('ALTER TABLE dafo_tipus_qe DROP FOREIGN KEY FK_5E1D14B1B974A25F');
        $this->addSql('ALTER TABLE sub_tipus_qe DROP FOREIGN KEY FK_C63F7E8D6D8F41FE');
        $this->addSql('ALTER TABLE dafo_tipus_qi DROP FOREIGN KEY FK_57AB589A1397BB9D');
        $this->addSql('ALTER TABLE dafo_tipus_qe DROP FOREIGN KEY FK_5E1D14B11397BB9D');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491011F129');
        $this->addSql('ALTER TABLE questions_externes DROP FOREIGN KEY FK_C3428BEC1011F129');
        $this->addSql('ALTER TABLE empresa DROP FOREIGN KEY FK_B8D75A50CDCE378D');
        $this->addSql('ALTER TABLE questions_internes DROP FOREIGN KEY FK_90E337571011F129');
        $this->addSql('ALTER TABLE questions_externes DROP FOREIGN KEY FK_C3428BEC821C8592');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649521E1991');
        $this->addSql('ALTER TABLE questions_externes DROP FOREIGN KEY FK_C3428BEC521E1991');
        $this->addSql('ALTER TABLE questions_internes DROP FOREIGN KEY FK_90E33757521E1991');
        $this->addSql('ALTER TABLE centro DROP FOREIGN KEY FK_2675036B602B00EE');
        $this->addSql('ALTER TABLE aspecte_q DROP FOREIGN KEY FK_556D6A54FC8006E1');
        $this->addSql('ALTER TABLE dafo_tipus_qi DROP FOREIGN KEY FK_57AB589A7C92792A');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649298137A7');
        $this->addSql('ALTER TABLE questions_externes DROP FOREIGN KEY FK_C3428BEC298137A7');
        $this->addSql('ALTER TABLE questions_internes DROP FOREIGN KEY FK_90E33757298137A7');
        $this->addSql('ALTER TABLE factor_critico_de_exito DROP FOREIGN KEY FK_753784AEA4CAF78E');
        $this->addSql('ALTER TABLE binomio_aspecte_q DROP FOREIGN KEY FK_3B7BFE1CA4CAF78E');
        $this->addSql('ALTER TABLE questions_internes DROP FOREIGN KEY FK_90E33757898C381B');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE aspecte_q');
        $this->addSql('DROP TABLE dafo_tipus_qi');
        $this->addSql('DROP TABLE questions_externes');
        $this->addSql('DROP TABLE tipus_qe');
        $this->addSql('DROP TABLE dafo');
        $this->addSql('DROP TABLE corporacion');
        $this->addSql('DROP TABLE dafo_tipus_qe');
        $this->addSql('DROP TABLE sub_tipus_qe');
        $this->addSql('DROP TABLE empresa');
        $this->addSql('DROP TABLE questions_internes');
        $this->addSql('DROP TABLE trabajador');
        $this->addSql('DROP TABLE rol');
        $this->addSql('DROP TABLE emergente');
        $this->addSql('DROP TABLE factor_critico_de_exito');
        $this->addSql('DROP TABLE macroentorno');
        $this->addSql('DROP TABLE centro');
        $this->addSql('DROP TABLE binomio');
        $this->addSql('DROP TABLE binomio_aspecte_q');
        $this->addSql('DROP TABLE tipus_qi');
    }
}
