<?php

namespace app\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use \app\models\Settings as SettingsBase;
use yii\web\UploadedFile;

class Settings extends SettingsBase
{
    private const COMPANY_NAME = 'company_name';
    private const LOGO = 'logo';

    private $companyName;
    private $logo;

    public function rules(): array
    {
        return [
            [['companyName'], 'string'],
            [['logo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'gif, png, jpg, jpeg'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'companyName' => Yii::t('settings', 'Company Name'),
            'logo' => Yii::t('settings', 'Logo')
        ];
    }

    /**
     * @param string $attr
     * @param string $value
     * @return bool
     */
    private static function set(string $attr, string $value): bool
    {
        $conf = SettingsBase::findOne($attr);
        $conf->setAttribute('value', $value);
        return $conf->save();
    }

    /**
     * @param string $attr
     * @return string
     * @throws \Exception
     */
    private static function get(string $attr): ?string
    {
        $conf = parent::findOne($attr);
        return ArrayHelper::getValue($conf, 'value');
    }

    public function save($runValidation = [], $attributes = [])
    {
        $flag = true;
        if ($this->companyName) {
            $value = $this->companyName;
            $flag = $this->set(self::COMPANY_NAME, (string)$value);
        }
        if ($flag && isset($this->logo) && ($file = UploadedFile::getInstance($this, 'logo'))) {
            $filename = '';
            if ($file) {
                $filename = '/uploads/custom_logo.' . $file->extension;
                $file->saveAs(\Yii::getAlias('@app/web' . $filename));
            }
            $flag = $this->set(self::LOGO, $filename);
        }
        return $flag;
    }

    public function getLogo()
    {
        return self::get(self::LOGO);
    }

    /**
     * @param string $logo
     */
    public function setLogo($logo): void
    {
        $this->logo = $logo;
    }

    public function getCompanyName()
    {
        return self::get(self::COMPANY_NAME);
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName): void
    {
        $this->companyName = $companyName;
    }

    public function unsetLogo()
    {
        $logo = self::get(self::LOGO);
        if ($logo && str_contains('uploads', $logo) && file_exists(\Yii::getAlias('@app/web' . $logo))) {
            unlink(\Yii::getAlias('@app/web/' . $logo));
        }
        return self::set(self::LOGO, 'logo.png');
    }
}
