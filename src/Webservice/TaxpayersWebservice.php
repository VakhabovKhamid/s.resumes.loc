<?php
/**
 * Created by PhpStorm.
 * User: I-Iomer
 * Date: 30.06.2018
 * Time: 17:19
 */

namespace App\Webservice;

use Muffin\Webservice\Query;
use Muffin\Webservice\ResultSet;
use Muffin\Webservice\Webservice\Webservice;

class TaxpayersWebservice extends Webservice
{
    /**
     * Returns the base URL for this endpoint
     *
     * @return string Base URL
     */
    public function getBaseUrl()
    {
        return '/' . $this->getEndpoint();
    }

    /**
     * {@inheritDoc}
     */
    /**
     * {@inheritDoc}
     */
    protected function _executeReadQuery(Query $query, array $options = [])
    {
        $conditions = $query->where();

        if (!isset($conditions['Taxpayers.document_seria']) || !isset($conditions['Taxpayers.document_number'])) {
            return false;
        }

        $response = $this->driver()->client()->get('/mehnat/wsgnk2mv?action=check_tin&pass_ser='.$conditions['Taxpayers.document_seria'].'&pass_num='.$conditions['Taxpayers.document_number']);


        if (!$response->isOk()) {
            return false;
        }

        if ($response->json['err_code'] != '0') {
            return false;
        }

        $row = $response->json['root'];
        $resources = $this->_transformResults($query->endpoint(), $row);

        return new ResultSet($resources, count($row));
    }
}