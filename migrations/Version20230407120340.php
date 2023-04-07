<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230407120340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reactions DROP FOREIGN KEY FK_38737FB3E85F12B8');
        $this->addSql('DROP INDEX IDX_38737FB3E85F12B8 ON reactions');
        $this->addSql('DROP INDEX `primary` ON reactions');
        $this->addSql('ALTER TABLE reactions ADD post_id VARCHAR(255) NOT NULL, DROP post_id_id');
        $this->addSql('ALTER TABLE reactions ADD PRIMARY KEY (user_id, post_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `PRIMARY` ON reactions');
        $this->addSql('ALTER TABLE reactions ADD post_id_id INT NOT NULL, DROP post_id');
        $this->addSql('ALTER TABLE reactions ADD CONSTRAINT FK_38737FB3E85F12B8 FOREIGN KEY (post_id_id) REFERENCES posts (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_38737FB3E85F12B8 ON reactions (post_id_id)');
        $this->addSql('ALTER TABLE reactions ADD PRIMARY KEY (user_id, post_id_id)');
    }
}
