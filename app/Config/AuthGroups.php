<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
    public string $defaultGroup = 'pelanggan';

    /**
     * --------------------------------------------------------------------
     * Groups
     * --------------------------------------------------------------------
     * An associative array of the available groups in the system, where the keys
     * are the group names and the values are arrays of the group info.
     *
     * Whatever value you assign as the key will be used to refer to the group
     * when using functions such as:
     *      $user->addGroup('superadmin');
     *
     * @var array<string, array<string, string>>
     *
     * @see https://codeigniter4.github.io/shield/quick_start_guide/using_authorization/#change-available-groups for more info
     */
    public array $groups = [
        'owner' =>[
            'title' => 'owner toko',
            'description' => 'should be enough'
        ],
        'admin_toko' => [
            'title'       => 'admin',
            'description' => 'Complete control of the site.',
        ],
        'pelanggan' => [
            'title'       => 'mitra_kopsis',
            'description' => 'Day to day administrators of the site.',
        ],

    ];

    /**
     * --------------------------------------------------------------------
     * Permissions
     * --------------------------------------------------------------------
     * The available permissions in the system.
     *
     * If a permission is not listed here it cannot be used.
     */

    public array $permissions = [
        // admin toko
        'admin_toko.crud_barang' => 'can crud barang',
        'admin_toko.crud_kategori_barang' => 'can crud kategori barang',
        'admin_toko.transaksi' => 'bisa transaksi',
        'admin_toko.cetak_struk' => 'bisa cetak struk',
        'admin_toko.history_penjualan_access' => 'access histori penjualan',

        // pelanggan
        'pelanggan.page_access' => 'bisa akses list produk itu',
        'pelanggan.transaksi' => 'bisa "transaksi" produk yang diinginkan',
        'pelanggan.transaksi_history' => 'bisa melihat history "transaksi" ',

        // owner
        'owner.transaksi_access' => 'can melihat transaksi',
        'owner.page_access' => 'can melihat page owner'
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions Matrix
     * --------------------------------------------------------------------
     * Maps permissions to groups.
     *
     * This defines group-level permissions.
     */
    public array $matrix = [
        'admin_toko' => [
            'admin_toko.*'
        ],

        'owner' => [
            'owner.*',
            'admin_toko.history_penjualan_access'
        ],

        'pelanggan' => [
            'pelanggan.*'
        ]

    ];
}
