<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190326185244 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD user_emp_id INT DEFAULT NULL, ADD user_cent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491F342B35 FOREIGN KEY (user_emp_id) REFERENCES empresa (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497C59EB20 FOREIGN KEY (user_cent_id) REFERENCES centro (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6491F342B35 ON user (user_emp_id)');
        $this->addSql('CREATE INDEX IDX_8D93D6497C59EB20 ON user (user_cent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491F342B35');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497C59EB20');
        $this->addSql('DROP INDEX IDX_8D93D6491F342B35 ON user');
        $this->addSql('DROP INDEX IDX_8D93D6497C59EB20 ON user');
        $this->addSql('ALTER TABLE user DROP user_emp_id, DROP user_cent_id');
    }
}
